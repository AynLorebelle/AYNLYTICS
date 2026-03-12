<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Accept two modes:
        // 1) Single month queries: ?month=5&year=2025 (backwards-compatible)
        // 2) Range queries from the period modal: ?from=2025-05&to=2025-07 (YYYY-MM)
        $fromParam = $request->query('from');
        $toParam = $request->query('to');

        // Defaults: current month
        $fromMonth = null;
        $toMonth = null;
        $rangeStart = null;
        $rangeEnd = null;

        if ($fromParam && $toParam) {
            // Parse YYYY-MM
            try {
                $rangeStart = Carbon::createFromFormat('Y-m', $fromParam)->startOfMonth();
                $rangeEnd = Carbon::createFromFormat('Y-m', $toParam)->endOfMonth();

                // normalize from/to strings for the view (YYYY-MM)
                $fromMonth = $rangeStart->format('Y-m');
                $toMonth = $rangeEnd->format('Y-m');

            } catch (\Exception $e) {
                // fallback to current month on parse error
                $rangeStart = Carbon::now()->startOfMonth();
                $rangeEnd = Carbon::now()->endOfMonth();
                $fromMonth = $rangeStart->format('Y-m');
                $toMonth = $rangeEnd->format('Y-m');
            }

        } else {
            // backwards-compatible single month mode
            $month = (int) $request->input('month', Carbon::now()->month);
            $year = (int) $request->input('year', Carbon::now()->year);

            $rangeStart = Carbon::create($year, $month, 1)->startOfMonth();
            $rangeEnd = $rangeStart->copy()->endOfMonth();
            $fromMonth = $rangeStart->format('Y-m');
            $toMonth = $rangeEnd->format('Y-m');
        }

        // Totals between the date range (inclusive)
        $totalIncome = (float) DB::table('incomes')
            ->where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->whereBetween('transaction_date', [$rangeStart->toDateString(), $rangeEnd->toDateString()])
            ->sum('amount');

        $totalExpenses = (float) DB::table('expenses')
            ->where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->whereBetween('transaction_date', [$rangeStart->toDateString(), $rangeEnd->toDateString()])
            ->sum('amount');

        $totalBudget = (float) DB::table('budgets')
            ->where('user_id', $user->id)
            ->where('month', $rangeStart->month)
            ->where('year', $rangeStart->year)
            ->sum('amount');

        $budgetUsagePercent = $totalBudget > 0 ? round(($totalExpenses / $totalBudget) * 100, 1) : 0;
        $savingsRate = $totalIncome > 0 ? round((($totalIncome - $totalExpenses) / $totalIncome) * 100, 1) : 0;

        $expensesByCategory = $this->getExpensesByCategory($user->id, $rangeStart, $rangeEnd);
        $trend = $this->getMonthlyTrend($user->id, 6);
        $budgetPerf = $this->getBudgetPerformance($user->id, $rangeStart, $rangeEnd);
        $daily = $this->getDailyExpenses($user->id, $rangeStart->year, $rangeStart->month);

        return view('analytics.index', compact(
            'expensesByCategory',
            'trend',
            'budgetPerf',
            'daily',
            'fromMonth',
            'toMonth',
            'totalIncome',
            'totalExpenses',
            'totalBudget',
            'budgetUsagePercent',
            'savingsRate'
        ));
    }

    protected function getExpensesByCategory($userId, Carbon $start, Carbon $end)
    {
        $rows = DB::table('expenses')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('SUM(expenses.amount) as total'))
            ->where('expenses.user_id', $userId)
            ->whereNull('expenses.deleted_at')
            ->whereBetween('expenses.transaction_date', [$start->toDateString(), $end->toDateString()])
            ->groupBy('categories.name')
            ->get();

        $labels = $rows->pluck('category')->toArray();
        $data = $rows->pluck('total')->map(fn($v) => (float)$v)->toArray();

        return compact('labels', 'data');
    }

    protected function getMonthlyTrend($userId, $months = 6)
    {
        $labels = [];
        $income = [];
        $expenses = [];
        $now = Carbon::now();

        for ($i = $months - 1; $i >= 0; $i--) {
            $dt = $now->copy()->subMonths($i);
            $labels[] = $dt->format('M Y');
            $m = $dt->month;
            $y = $dt->year;

            $inc = DB::table('incomes')
                ->where('user_id', $userId)
                ->whereNull('deleted_at')
                ->whereMonth('transaction_date', $m)
                ->whereYear('transaction_date', $y)
                ->sum('amount');

            $exp = DB::table('expenses')
                ->where('user_id', $userId)
                ->whereNull('deleted_at')
                ->whereMonth('transaction_date', $m)
                ->whereYear('transaction_date', $y)
                ->sum('amount');

            $income[] = (float) $inc;
            $expenses[] = (float) $exp;
        }

        $balance = [];
        for ($i = 0; $i < count($labels); $i++) {
            $balance[] = $income[$i] - $expenses[$i];
        }

        return compact('labels', 'income', 'expenses', 'balance');
    }

protected function getBudgetPerformance($userId, Carbon $start, Carbon $end)
{
    $month = $start->month;
    $year = $start->year;

    $rows = DB::table('budgets')
        ->join('categories', 'budgets.category_id', '=', 'categories.id')
        ->leftJoin('expenses', function ($join) use ($month, $year, $userId) {
            $join->on('expenses.category_id', '=', 'budgets.category_id')
                 ->where('expenses.user_id', $userId)
                 ->whereNull('expenses.deleted_at')
                 ->whereMonth('expenses.transaction_date', $month)
                 ->whereYear('expenses.transaction_date', $year);
        })
        ->where('budgets.user_id', $userId)
        ->where('budgets.month', $month)
        ->where('budgets.year', $year)
        ->select('categories.name as category', 'budgets.amount as budget', DB::raw('COALESCE(SUM(expenses.amount),0) as spent'))
        ->groupBy('categories.name', 'budgets.amount')
        ->get();

    $labels = $rows->pluck('category')->toArray();
    $budgets = $rows->pluck('budget')->map(fn($v) => (float)$v)->toArray();
    $spent = $rows->pluck('spent')->map(fn($v) => (float)$v)->toArray();

    // 🔥 FIX — calculate totals
    $totalBudget = array_sum($budgets);
    $totalSpent = array_sum($spent);

    // 🔥 FIX — calculate percentage
    $percentage = $totalBudget > 0 
        ? round(($totalSpent / $totalBudget) * 100, 2)
        : 0;

    return [
        'labels' => $labels,
        'budgets' => $budgets,
        'spent' => $spent,
        'totalBudget' => $totalBudget,
        'totalSpent' => $totalSpent,
        'percentage' => $percentage,
    ];
}


    protected function getDailyExpenses($userId, $year, $month)
    {
        $dt = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $dt->daysInMonth;

        $labels = [];
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $labels[] = (string) $d;
        }

        $expensesByDay = array_fill(0, $daysInMonth, 0.0);
        $incomeByDay = array_fill(0, $daysInMonth, 0.0);

        $expRows = DB::table('expenses')
            ->select(DB::raw('DAY(transaction_date) as day'), DB::raw('SUM(amount) as total'))
            ->where('user_id', $userId)
            ->whereNull('deleted_at')
            ->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->groupByRaw('DAY(transaction_date)')
            ->get();

        foreach ($expRows as $r) {
            $idx = ((int) $r->day) - 1;
            if ($idx >= 0 && $idx < $daysInMonth) {
                $expensesByDay[$idx] = (float) $r->total;
            }
        }

        $incRows = DB::table('incomes')
            ->select(DB::raw('DAY(transaction_date) as day'), DB::raw('SUM(amount) as total'))
            ->where('user_id', $userId)
            ->whereNull('deleted_at')
            ->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->groupByRaw('DAY(transaction_date)')
            ->get();

        foreach ($incRows as $r) {
            $idx = ((int) $r->day) - 1;
            if ($idx >= 0 && $idx < $daysInMonth) {
                $incomeByDay[$idx] = (float) $r->total;
            }
        }

        $net = [];
        for ($i = 0; $i < $daysInMonth; $i++) {
            $net[] = $incomeByDay[$i] - $expensesByDay[$i];
        }

        return compact('labels', 'net');
    }
}
