<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $expenses = Expense::with('category')->where('user_id', $user->id)->latest()->paginate(20);
        $unreadCount = Expense::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count() + Income::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count();
        return view('expenses.index', compact('expenses', 'unreadCount'));
    }

    public function create()
    {
        $categories = $this->categoriesForUser('expense');
        $expense = new Expense();
        return view('expenses.create', compact('categories','expense'));
    }

    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        try {
            Expense::create($data);
            return redirect()->route('expenses.index')->with('success', 'Expense created');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to create expense. Please try again.');
        }
    }

    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        $categories = $this->categoriesForUser('expense');
        return view('expenses.edit', compact('expense','categories'));
    }

    public function update(ExpenseRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);
        try {
            $expense->update($request->validated());
            return redirect()->route('expenses.index')->with('success', 'Expense updated');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to update expense. Please try again.');
        }
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        try {
            $expense->delete();
            return back()->with('success', 'Expense deleted');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Unable to delete expense.');
        }
    }
}
