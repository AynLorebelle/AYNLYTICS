<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $today = now();
        $month = $request->input('month', $today->month);
        $year = $request->input('year', $today->year);

        // totals this month
        $totalExpenses = (float) Expense::where('user_id', $user->id)->forMonth($month, $year)->sum('amount');
        $totalIncomes = (float) Income::where('user_id', $user->id)->forMonth($month, $year)->sum('amount');
        $totalBudgets = (float) Budget::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('amount');

        // previous month context (for percentage change)
        $prev = Carbon::create($year, $month, 1)->subMonth();
        $prevMonth = $prev->month; $prevYear = $prev->year;

        $prevExpenses = (float) Expense::where('user_id', $user->id)->forMonth($prevMonth, $prevYear)->sum('amount');
        $prevIncomes = (float) Income::where('user_id', $user->id)->forMonth($prevMonth, $prevYear)->sum('amount');
        $prevBudgets = (float) Budget::where('user_id', $user->id)->where('month', $prevMonth)->where('year', $prevYear)->sum('amount');

        // helper to compute percent change safely
        $percentChange = function (float $current, float $previous) {
            if ($previous <= 0) {
                if ($current <= 0) return ['label' => 'N/A', 'value' => null, 'direction' => 'neutral'];
                return ['label' => 'New', 'value' => null, 'direction' => 'positive'];
            }

            $change = (($current - $previous) / $previous) * 100;
            $direction = $change > 0 ? 'positive' : ($change < 0 ? 'negative' : 'neutral');

            return ['label' => round($change, 1), 'value' => $change, 'direction' => $direction];
        };

        $budgetChange = $percentChange($totalBudgets, $prevBudgets);
        $incomeChange = $percentChange($totalIncomes, $prevIncomes);
        $expenseChange = $percentChange($totalExpenses, $prevExpenses);

        // savings percentage for this month (income vs expenses)
        $savingsPercent = null;
        if ($totalIncomes > 0) {
            $savingsPercent = round((($totalIncomes - $totalExpenses) / $totalIncomes) * 100, 1);
        }

        // previous month savings and percent-change for savings
        $prevSavingsPercent = null;
        if ($prevIncomes > 0) {
            $prevSavingsPercent = round((($prevIncomes - $prevExpenses) / $prevIncomes) * 100, 1);
        }

        // percent change for savings (compare current to previous)
        if ($prevSavingsPercent === null) {
            if ($savingsPercent === null) {
                $savingsChange = ['label' => 'N/A', 'value' => null, 'direction' => 'neutral'];
            } else {
                $savingsChange = ['label' => 'New', 'value' => null, 'direction' => 'positive'];
            }
        } else {
            $diff = $savingsPercent - $prevSavingsPercent;
            $savingsChange = ['label' => round($diff, 1), 'value' => $diff, 'direction' => $diff > 0 ? 'positive' : ($diff < 0 ? 'negative' : 'neutral')];
        }

        // Recent transactions (merge of incomes & expenses), get last 20 from each then sort, take 10
        $rawExpenses = Expense::where('user_id', $user->id)->with('category')->orderByDesc('transaction_date')->take(20)->get();
        $rawIncomes = Income::where('user_id', $user->id)->with('category')->orderByDesc('transaction_date')->take(20)->get();

        $transactions = collect();

        foreach ($rawExpenses as $e) {
            $transactions->push([
                'id' => $e->id,
                'type' => 'expense',
                'name' => $e->description ?: ($e->category->name ?? 'Expense'),
                'category' => $e->category->name ?? null,
                'amount' => (float) $e->amount,
                'transaction_date' => $e->transaction_date,
            ]);
        }

        foreach ($rawIncomes as $i) {
            $transactions->push([
                'id' => $i->id,
                'type' => 'income',
                'name' => $i->description ?: ($i->category->name ?? 'Income'),
                'category' => $i->category->name ?? null,
                'amount' => (float) $i->amount,
                'transaction_date' => $i->transaction_date,
            ]);
        }

        // sort and take 10 (most recent first)
        $recentTransactions = $transactions->sortByDesc('transaction_date')->slice(0, 10)->values();

        return view('dashboard', compact(
            'totalExpenses', 'totalIncomes', 'totalBudgets',
            'prevExpenses', 'prevIncomes', 'prevBudgets',
            'budgetChange', 'incomeChange', 'expenseChange', 'savingsPercent', 'savingsChange',
            'recentTransactions'
        ));
    }

    /**
     * Return JSON for dashboard charts
     */
    public function charts(Request $request)
    {
        $user = $request->user();

        $today = now();
        $month = $request->input('month', $today->month);
        $year = $request->input('year', $today->year);

        // 1) Expenses by category (current month)
        $categories = Category::where(function ($q) use ($user) {
            $q->where('is_system', true)->orWhere('user_id', $user->id);
        })->get();

        $byCategory = Expense::selectRaw('categories.id as category_id, categories.name as category_name, categories.color as category_color, SUM(expenses.amount) as total')
            ->join('categories', 'categories.id', '=', 'expenses.category_id')
            ->where('expenses.user_id', $user->id)
            ->whereYear('expenses.transaction_date', $year)
            ->whereMonth('expenses.transaction_date', $month)
            ->groupBy('categories.id', 'categories.name', 'categories.color')
            ->orderByDesc('total')
            ->get();

        $totalByCategorySum = $byCategory->sum('total');

        $expensesByCategory = $byCategory->map(function ($row) use ($totalByCategorySum) {
            return [
                'id' => (int) $row->category_id,
                'label' => $row->category_name,
                'color' => $row->category_color ?? '#3b82f6',
                'value' => (float) $row->total,
                'percent' => $totalByCategorySum > 0 ? round(($row->total / $totalByCategorySum) * 100, 1) : 0,
            ];
        });

        // 2) Income vs expenses trend (last 6 months)
        $months = [];
        $incomeSeries = [];
        $expenseSeries = [];
        $balanceSeries = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $m = $date->month;
            $y = $date->year;
            $months[] = $date->format('M');

            $inc = Income::where('user_id', $user->id)->whereYear('transaction_date', $y)->whereMonth('transaction_date', $m)->sum('amount');
            $exp = Expense::where('user_id', $user->id)->whereYear('transaction_date', $y)->whereMonth('transaction_date', $m)->sum('amount');

            $incomeSeries[] = (float) $inc;
            $expenseSeries[] = (float) $exp;
            $balanceSeries[] = (float) ($inc - $exp);
        }

        // 3) Budget performance per category (current month)
        $budgets = Budget::with('category')->where('user_id', $user->id)->where('month', $month)->where('year', $year)->get();

        $budgetPerformance = $budgets->map(function ($b) use ($user, $month, $year) {
            $spent = Expense::where('user_id', $user->id)->where('category_id', $b->category_id)->whereYear('transaction_date', $year)->whereMonth('transaction_date', $month)->sum('amount');
            $used = $b->amount > 0 ? round(($spent / $b->amount) * 100, 1) : 0;
            return [
                'category_id' => $b->category_id,
                'label' => $b->category->name ?? 'Category',
                'color' => $b->category->color ?? '#3b82f6',
                'budget' => (float) $b->amount,
                'spent' => (float) $spent,
                'used_percent' => $used,
                'over' => $spent > $b->amount,
            ];
        });

        // 4) Daily spending for current month
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $daily = [];
        $cumulative = 0.0;
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $dateStr = Carbon::create($year, $month, $d)->format('Y-m-d');
            $sum = Expense::where('user_id', $user->id)->whereDate('transaction_date', $dateStr)->sum('amount');
            $cumulative += (float) $sum;
            $daily[] = ['day' => $d, 'date' => $dateStr, 'amount' => (float) $sum, 'cumulative' => $cumulative];
        }

        return response()->json([
            'expenses_by_category' => $expensesByCategory,
            'trend' => [
                'labels' => $months,
                'income' => $incomeSeries,
                'expenses' => $expenseSeries,
                'balance' => $balanceSeries,
            ],
            'budget_performance' => $budgetPerformance,
            'daily_spending' => $daily,
        ]);
    }
}
