<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $budgets = Budget::with('category')->where('user_id', $user->id)->orderBy('year', 'desc')->orderBy('month', 'desc')->paginate(50);
        $unreadCount = Expense::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count() + Income::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count();
        return view('budgets.index', compact('budgets', 'unreadCount'));
    }

    public function create()
    {
        $categories = $this->categoriesForUser();
        $budget = new Budget();
        return view('budgets.create', compact('categories','budget'));
    }

    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);
        $categories = $this->categoriesForUser();
        return view('budgets.edit', compact('budget','categories'));
    }

    public function store(BudgetRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        try {
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
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to save budget.');
        }
    }

    public function update(BudgetRequest $request, Budget $budget)
    {
        $this->authorize('update', $budget);
        try {
            $budget->update($request->validated());
            return redirect()->route('budgets.index')->with('success', 'Budget updated');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to update budget.');
        }
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);
        try {
            $budget->delete();
            return back()->with('success', 'Budget deleted');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Unable to delete budget.');
        }
    }
}
