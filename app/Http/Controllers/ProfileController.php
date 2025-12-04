<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        // Calculate total budget for current month
        $totalBudget = (float) DB::table('budgets')
            ->where('user_id', $user->id)
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->sum('amount');
        
        // Calculate total expenses for current month
        $totalExpenses = (float) DB::table('expenses')
            ->where('user_id', $user->id)
            ->whereMonth('transaction_date', $currentMonth)
            ->whereYear('transaction_date', $currentYear)
            ->sum('amount');
        
        // Calculate total income for current month
        $totalIncome = (float) DB::table('incomes')
            ->where('user_id', $user->id)
            ->whereMonth('transaction_date', $currentMonth)
            ->whereYear('transaction_date', $currentYear)
            ->sum('amount');
        
        // Calculate remaining balance
        $remaining = $totalBudget - $totalExpenses;
        
        // Get recent activity (last 5 activities)
$recentExpenses = DB::table('expenses')
    ->join('categories', 'expenses.category_id', '=', 'categories.id')
    ->select('expenses.description', 'expenses.amount', 'expenses.transaction_date', 'categories.name as category')
    ->where('expenses.user_id', $user->id)
    ->orderBy('expenses.transaction_date', 'desc')
    ->limit(3)
    ->get();

// Updated query - check your actual column names
$recentIncomes = DB::table('incomes')
    ->select('description', 'amount', 'transaction_date') // Changed 'source' to 'description'
    ->where('user_id', $user->id)
    ->orderBy('transaction_date', 'desc')
    ->limit(2)
    ->get();
        
        return view('profile.edit', compact(
            'user',
            'totalBudget',
            'totalExpenses',
            'totalIncome',
            'remaining',
            'recentExpenses',
            'recentIncomes'
        ));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}