<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;
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

        $totalExpenses = Expense::where('user_id', $user->id)->forMonth($month, $year)->sum('amount');
        $totalIncomes = Income::where('user_id', $user->id)->forMonth($month, $year)->sum('amount');

        $budgets = Budget::where('user_id', $user->id)->where('month', $month)->where('year', $year)->get();

        return view('dashboard', compact('totalExpenses', 'totalIncomes', 'budgets'));
    }
}
