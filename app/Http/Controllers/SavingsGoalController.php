<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SavingsGoal;
use App\Models\SavingsContribution;
use Carbon\Carbon;

class SavingsGoalController extends Controller
{
    public function index()
    {
        $goals = SavingsGoal::where('user_id', auth()->id())
            ->where('status', '!=', 'cancelled')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($goal) {
                $totalSaved     = $goal->totalSaved();
                $progressPercent = $goal->progressPercent();
                $remaining      = $goal->remaining();
                $monthsLeft     = null;

                if ($goal->target_date) {
                    $monthsLeft = max(0, (int) now()->diffInMonths($goal->target_date, false));
                }

                $monthlySuggested = ($monthsLeft && $monthsLeft > 0)
                    ? round($remaining / $monthsLeft, 2)
                    : null;

                return array_merge($goal->toArray(), [
                    'total_saved'       => $totalSaved,
                    'progress_percent'  => $progressPercent,
                    'remaining'         => $remaining,
                    'months_left'       => $monthsLeft,
                    'monthly_suggested' => $monthlySuggested,
                    'contributions'     => $goal->contributions()
                        ->orderBy('contributed_at', 'desc')
                        ->take(5)
                        ->get(),
                ]);
            });

        return view('savings.index', compact('goals'));


    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'target_amount'    => 'required|numeric|min:1',
            'monthly_percent'  => 'nullable|numeric|min:0|max:100',
            'target_date'      => 'nullable|date|after:today',
            'notes'            => 'nullable|string',
        ]);

        SavingsGoal::create([
            'user_id'          => auth()->id(),
            'name'             => $request->name,
            'target_amount'    => $request->target_amount,
            'monthly_percent'  => $request->monthly_percent,
            'target_date'      => $request->target_date,
            'notes'            => $request->notes,
        ]);

        return redirect()->route('savings.index')->with('success', 'Savings goal created!');
    }

    public function contribute(Request $request, SavingsGoal $savingsGoal)
    {
        abort_if($savingsGoal->user_id !== auth()->id(), 403);

        $request->validate([
            'amount'         => 'required|numeric|min:1',
            'contributed_at' => 'required|date',
            'notes'          => 'nullable|string',
        ]);

        SavingsContribution::create([
            'savings_goal_id' => $savingsGoal->id,
            'user_id'         => auth()->id(),
            'amount'          => $request->amount,
            'contributed_at'  => $request->contributed_at,
            'notes'           => $request->notes,
        ]);

        if ($savingsGoal->progressPercent() >= 100) {
            $savingsGoal->update(['status' => 'completed']);
        }

        return redirect()->route('savings.index')->with('success', 'Contribution added!');
    }

    public function destroy(SavingsGoal $savingsGoal)
    {
        abort_if($savingsGoal->user_id !== auth()->id(), 403);
        $savingsGoal->update(['status' => 'cancelled']);
        return redirect()->route('savings.index')->with('success', 'Goal removed.');
    }

    public function aiAdvice(SavingsGoal $savingsGoal)
    {
        abort_if($savingsGoal->user_id !== auth()->id(), 403);

        $userId   = auth()->id();
        $totalSaved    = $savingsGoal->totalSaved();
        $remaining     = $savingsGoal->remaining();
        $monthsLeft    = $savingsGoal->target_date
            ? max(0, (int) now()->diffInMonths($savingsGoal->target_date, false))
            : null;

        // Get user's income for context
        $monthlyIncome = \App\Models\Income::where('user_id', $userId)
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        $monthlyExpenses = \App\Models\Expense::where('user_id', $userId)
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        $prompt = "The user has a savings goal called '{$savingsGoal->name}' with a target of ₱{$savingsGoal->target_amount}. 
They have saved ₱{$totalSaved} so far ({$savingsGoal->progressPercent()}% complete) and need ₱{$remaining} more.
" . ($monthsLeft !== null ? "They have {$monthsLeft} months left to reach their deadline." : "No deadline set.") . "
Their monthly income this month is ₱{$monthlyIncome} and expenses are ₱{$monthlyExpenses}.
" . ($savingsGoal->monthly_percent ? "Their monthly savings target is {$savingsGoal->monthly_percent}% of income." : "") . "

Give specific, actionable advice on how they can reach this savings goal. Include:
- Whether they are on track
- How much they should save per month
- Specific expense reduction suggestions based on their income/expense ratio
- Encouragement
Keep it concise with bullet points.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.groq.key'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model'      => 'llama-3.3-70b-versatile',
            'max_tokens' => 512,
            'messages'   => [
                ['role' => 'system', 'content' => 'You are a helpful personal finance assistant for a Filipino budgeting app. Use ₱ for currency.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return response()->json([
            'advice' => $response->json('choices.0.message.content')
        ]);
    }
}

