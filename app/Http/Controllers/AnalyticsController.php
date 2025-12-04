<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
     public function index(Request $request)
     {
            $user = $request->user();
            $month = $request->input('month', now()->month);
            $year = $request->input('year', now()->year);
            
            // Calculate totals for summary cards
            $totalIncome = (float) DB::table('incomes')
                ->where('user_id', $user->id)
                ->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', $year)
                ->sum('amount');

            $totalExpenses = (float) DB::table('expenses')
                ->where('user_id', $user->id)
                ->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', $year)
                ->sum('amount');

            $totalBudget = (float) DB::table('budgets')
                ->where('user_id', $user->id)
                ->where('month', $month)
                ->where('year', $year)
                ->sum('amount');

            // Calculate budget usage percentage
            $budgetUsagePercent = $totalBudget > 0 ? round(($totalExpenses / $totalBudget) * 100, 1) : 0;

            // Calculate savings rate
            $savingsRate = $totalIncome > 0 ? round((($totalIncome - $totalExpenses) / $totalIncome) * 100, 1) : 0;
            
            $expensesByCategory = $this->getExpensesByCategory($user->id, $month, $year);
            $trend = $this->getMonthlyTrend($user->id, 6);
            $budgetPerf = $this->getBudgetPerformance($user->id, $month, $year);
            $daily = $this->getDailyExpenses($user->id, $month, $year);
            
            return view('analytics.index', compact(
                'expensesByCategory', 
                'trend', 
                'budgetPerf', 
                'daily', 
                'month', 
                'year',
                'totalIncome',
                'totalExpenses',
                'totalBudget',
                'budgetUsagePercent',
                'savingsRate'
            ));
     }

     
     protected function getExpensesByCategory($userId, $month, $year)
     {
            // Logic to get expenses by category
            $rows = DB::table('expenses')
                ->join('categories', 'expenses.category_id', '=', 'categories.id')
                ->select('categories.name as category', DB::raw('SUM(expenses.amount) as total'))
                ->where('expenses.user_id', $userId)
                ->whereMonth('expenses.transaction_date', $month)
                ->whereYear('expenses.transaction_date', $year)
                ->groupBy('categories.name')
                ->get();
            $labels = $rows->pluck('category');
            $data = $rows->pluck('total');
            return compact('labels', 'data');
     }

       protected function getMonthlyTrend($userId, $months = 6)
       {
              $labels = [];
              $income = [];
              $expenses = [];
              $now = \Carbon\Carbon::now();

              for ($i = $months - 1; $i >= 0; $i--) {
                     $dt = $now->copy()->subMonths($i);
                     $labels[] = $dt->format('M Y');
                     $m = $dt->month;
                     $y = $dt->year;

                     $inc = DB::table('incomes')
                            ->where('user_id', $userId)
                            ->whereMonth('transaction_date', $m)
                            ->whereYear('transaction_date', $y)
                            ->sum('amount');

                     $exp = DB::table('expenses')
                            ->where('user_id', $userId)
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

       protected function getBudgetPerformance($userId, $month, $year)
       {
              $rows = DB::table('budgets')
                     ->join('categories', 'budgets.category_id', '=', 'categories.id')
                     ->leftJoin('expenses', function ($join) use ($month, $year, $userId) {
                            $join->on('expenses.category_id', '=', 'budgets.category_id')
                                   ->where('expenses.user_id', $userId)
                                   ->whereMonth('expenses.transaction_date', $month)
                                   ->whereYear('expenses.transaction_date', $year);
                     })
                     ->where('budgets.user_id', $userId)
                     ->where('budgets.month', $month)
                     ->where('budgets.year', $year)
                     ->select('categories.name as category', 'budgets.amount as budget', DB::raw('COALESCE(SUM(expenses.amount),0) as spent'))
                     ->groupBy('categories.name', 'budgets.amount')
                     ->get();

              $labels = $rows->pluck('category');
              $budgets = $rows->pluck('budget');
              $spent = $rows->pluck('spent');

              return compact('labels', 'budgets', 'spent');
       }

       protected function getDailyExpenses($userId, $month, $year)
       {
              $dt = \Carbon\Carbon::createFromDate($year, $month, 1);
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