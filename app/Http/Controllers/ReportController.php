<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $from = $request->input('from');
        $to = $request->input('to');

        $expenses = Expense::with('category')->where('user_id', $user->id)
            ->when($from, fn($q) => $q->whereDate('transaction_date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('transaction_date', '<=', $to))
            ->orderBy('transaction_date','desc')
            ->paginate(50);

        $incomes = Income::with('category')->where('user_id', $user->id)
            ->when($from, fn($q) => $q->whereDate('transaction_date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('transaction_date', '<=', $to))
            ->orderBy('transaction_date','desc')
            ->paginate(50, ['*'], 'incomes_page');

        return view('reports.index', compact('expenses', 'incomes', 'from', 'to'));
    }
}
