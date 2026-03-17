<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIChatController extends Controller
{
    //Chabot IS RAG
    public function chat(Request $request)
    {
        try {
            $userMessage = $request->input('message');
            $userId = auth()->id();

            $financialData = $this->getUserFinancialData($userId);
            $systemPrompt = $this->buildSystemPrompt($financialData);
            $groqKey = $this->getGroqApiKey();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $groqKey,
                'Content-Type'  => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'      => 'llama-3.3-70b-versatile',
                'max_tokens' => 1024,
                'messages'   => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user',   'content' => $userMessage],
                ],
            ]);

            return response()->json([
                'reply' => $response->json('choices.0.message.content')
            ]);

        } catch (\Exception $e) {
            return response()->json(['reply' => 'ERROR: ' . $e->getMessage()], 500);
        }
    }

    private function getGroqApiKey(): string
{
    return config('services.groq.key');
}

    private function getUserFinancialData($userId): array
    {
        $expenses = \App\Models\Expense::where('user_id', $userId)
            ->whereNull('deleted_at')
            ->orderBy('transaction_date', 'desc')
            ->take(100)
            ->get(['amount', 'category_id', 'description', 'transaction_date']);

        $incomes = \App\Models\Income::where('user_id', $userId)
            ->whereNull('deleted_at')
            ->orderBy('transaction_date', 'desc')
            ->take(100)
            ->get(['amount', 'description', 'transaction_date']);

        $budgets = \App\Models\Budget::where('user_id', $userId)
            ->get(['category_id', 'amount', 'month', 'year']);

        $totalExpenses = $expenses->sum('amount');
        $totalIncome   = $incomes->sum('amount');

        return [
            'total_income'    => $totalIncome,
            'total_expenses'  => $totalExpenses,
            'net_savings'     => $totalIncome - $totalExpenses,
            'budgets'         => $budgets->toArray(),
            'recent_expenses' => $expenses->take(10)->toArray(),
            'recent_incomes'  => $incomes->take(10)->toArray(),
        ];
    }

    private function buildSystemPrompt(array $data): string
    {
        $dataJson = json_encode($data, JSON_PRETTY_PRINT);

        return <<<PROMPT
You are a personal finance AI assistant for the Aynlytics budgeting app.
You have access to the user's real financial data below.
Give specific, actionable advice based on their actual numbers.
Be concise, friendly, and use bullet points where helpful.

USER'S FINANCIAL DATA:
{$dataJson}

Guidelines:
- Reference specific numbers from their data
- Identify overspending categories
- Suggest concrete savings strategies
- Flag if they are exceeding any budgets
- Be encouraging but honest
PROMPT;
    }
}