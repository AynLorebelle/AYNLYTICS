<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Models\Category;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class IncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $incomes = Income::with('category')->where('user_id', $user->id)->latest()->paginate(20);
        $unreadCount = Expense::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count() + Income::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count();
        return view('incomes.index', compact('incomes', 'unreadCount'));
    }

    public function create()
    {
        $categories = $this->categoriesForUser('income');
        $income = new Income();
        return view('incomes.create', compact('categories','income'));
    }

    public function store(IncomeRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        try {
            Income::create($data);
            return redirect()->route('incomes.index')->with('success', 'Income created');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to create income. Please try again.');
        }
    }

    public function show(Income $income)
    {
        $this->authorize('view', $income);
        return view('incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        $this->authorize('update', $income);
        $categories = $this->categoriesForUser('income');
        return view('incomes.edit', compact('income','categories'));
    }

    public function update(IncomeRequest $request, Income $income)
    {
        $this->authorize('update', $income);
        try {
            $income->update($request->validated());
            return redirect()->route('incomes.index')->with('success', 'Income updated');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to update income. Please try again.');
        }
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', $income);
        try {
            $income->delete();
            return back()->with('success', 'Income deleted');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Unable to delete income.');
        }
    }
}
