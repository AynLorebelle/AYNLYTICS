<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $incomes = Income::where('user_id', $user->id)->latest()->paginate(20);
        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        $user = auth()->user();
        $categories = Category::where('type','income')->where(function($q) use ($user){ $q->where('is_system',true)->orWhere('user_id',$user->id); })->get();
        $income = new Income();
        return view('incomes.create', compact('categories','income'));
    }

    public function store(IncomeRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        Income::create($data);
        return redirect()->route('incomes.index')->with('success', 'Income created');
    }

    public function show(Income $income)
    {
        $this->authorize('view', $income);
        return view('incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        $this->authorize('update', $income);
        $user = auth()->user();
        $categories = Category::where('type','income')->where(function($q) use ($user){ $q->where('is_system',true)->orWhere('user_id',$user->id); })->get();
        return view('incomes.edit', compact('income','categories'));
    }

    public function update(IncomeRequest $request, Income $income)
    {
        $this->authorize('update', $income);
        $income->update($request->validated());
        return redirect()->route('incomes.index')->with('success', 'Income updated');
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', $income);
        $income->delete();
        return back()->with('success', 'Income deleted');
    }
}
