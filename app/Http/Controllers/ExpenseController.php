<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $expenses = Expense::where('user_id', $user->id)->latest()->paginate(20);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $user = auth()->user();
        $categories = Category::where('type','expense')->where(function($q) use ($user){ $q->where('is_system',true)->orWhere('user_id',$user->id); })->get();
        $expense = new Expense();
        return view('expenses.create', compact('categories','expense'));
    }

    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        Expense::create($data);
        return redirect()->route('expenses.index')->with('success', 'Expense created');
    }

    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        $user = auth()->user();
        $categories = Category::where('type','expense')->where(function($q) use ($user){ $q->where('is_system',true)->orWhere('user_id',$user->id); })->get();
        return view('expenses.edit', compact('expense','categories'));
    }

    public function update(ExpenseRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);
        $expense->update($request->validated());
        return redirect()->route('expenses.index')->with('success', 'Expense updated');
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();
        return back()->with('success', 'Expense deleted');
    }
}
