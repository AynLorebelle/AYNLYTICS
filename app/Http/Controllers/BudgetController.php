<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $budgets = Budget::where('user_id', $user->id)->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        return view('budgets.index', compact('budgets'));
    }

    public function create()
    {
        $user = auth()->user();
        $categories = Category::where(function($q) use ($user){ $q->where('is_system',true)->orWhere('user_id',$user->id); })->get();
        $budget = new Budget();
        return view('budgets.create', compact('categories','budget'));
    }

    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);
        $user = auth()->user();
        $categories = Category::where(function($q) use ($user){ $q->where('is_system',true)->orWhere('user_id',$user->id); })->get();
        return view('budgets.edit', compact('budget','categories'));
    }

    public function store(BudgetRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        Budget::updateOrCreate(
            [
                'user_id' => $data['user_id'],
                'category_id' => $data['category_id'],
                'month' => $data['month'],
                'year' => $data['year'],
            ],
            ['amount' => $data['amount']]
        );

        return redirect()->route('budgets.index')->with('success', 'Budget saved');
    }

    public function update(BudgetRequest $request, Budget $budget)
    {
        $this->authorize('update', $budget);
        $budget->update($request->validated());
        return redirect()->route('budgets.index')->with('success', 'Budget updated');
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);
        $budget->delete();
        return back()->with('success', 'Budget deleted');
    }
}
