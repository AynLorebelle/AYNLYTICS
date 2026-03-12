@extends('layouts.app')

@section('title', 'Dashboard - Aynlytics')

@section('content')
<main class="main-content">
    <div class="welcome-section">
        <h2>Welcome back!</h2>
        <p>Here's what's happening with your finances today.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <p class="stat-label">Remaining Budget</p>
            <div class="stat-row">
                <h3 class="stat-value" style="color: {{ $remainingBudget < 0 ? '#ef4444' : ($remainingBudget < $totalBudgets * 0.2 ? '#fbbf24' : '#ffffff') }}">
                    &#8369;{{ number_format($remainingBudget ?? 0, 2) }}
                </h3>
                @php $b = $budgetChange ?? null; @endphp
                <span class="stat-change {{ $b['direction'] ?? 'neutral' }}">
                    @if(isset($b['label']) && $b['label'] === 'N/A') N/A
                    @elseif(isset($b['label']) && $b['label'] === 'New') New
                    @else {{ ($b['label'] > 0 ? '+' : '') . ($b['label'] ?? 0) . '%' }}
                    @endif
                </span>
            </div>
            <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #1f2937;">
                <div style="display: flex; justify-content: space-between; font-size: 12px; color: #9ca3af; margin-bottom: 4px;">
                    <span>Total Budget</span>
                    <span style="color: #10b981;">&#8369;{{ number_format($totalBudgets ?? 0, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 12px; color: #9ca3af;">
                    <span>Total Spent</span>
                    <span style="color: #ef4444;">&#8369;{{ number_format($totalExpenses ?? 0, 2) }}</span>
                </div>
                @if($totalBudgets > 0)
                <div style="margin-top: 8px;">
                    <div style="background-color: #1f2937; height: 6px; border-radius: 3px; overflow: hidden;">
                        <div style="background-color: {{ $totalExpenses > $totalBudgets ? '#ef4444' : '#10b981' }}; height: 100%; width: {{ min(($totalExpenses / $totalBudgets) * 100, 100) }}%;"></div>
                    </div>
                    <p style="font-size: 11px; color: #6b7280; margin-top: 4px; text-align: center;">
                        {{ round(min(($totalExpenses / $totalBudgets) * 100, 100), 1) }}% used
                    </p>
                </div>
                @endif
            </div>
        </div>

        <div class="stat-card">
            <p class="stat-label">Monthly Income</p>
            <div class="stat-row">
                <h3 class="stat-value">&#8369;{{ number_format($totalIncomes ?? 0, 2) }}</h3>
                @php $ic = $incomeChange ?? null; @endphp
                <span class="stat-change {{ $ic['direction'] ?? 'neutral' }}">
                    @if(isset($ic['label']) && $ic['label'] === 'N/A') N/A
                    @elseif(isset($ic['label']) && $ic['label'] === 'New') New
                    @else {{ ($ic['label'] > 0 ? '+' : '') . ($ic['label'] ?? 0) . '%' }}
                    @endif
                </span>
            </div>
        </div>

        <div class="stat-card">
            <p class="stat-label">Expenses</p>
            <div class="stat-row">
                <h3 class="stat-value">&#8369;{{ number_format($totalExpenses ?? 0, 2) }}</h3>
                @php $ec = $expenseChange ?? null; @endphp
                <span class="stat-change {{ $ec['direction'] ?? 'neutral' }}">
                    @if(isset($ec['label']) && $ec['label'] === 'N/A') N/A
                    @elseif(isset($ec['label']) && $ec['label'] === 'New') New
                    @else {{ ($ec['label'] > 0 ? '+' : '') . ($ec['label'] ?? 0) . '%' }}
                    @endif
                </span>
            </div>
        </div>

        <div class="stat-card">
            <p class="stat-label">Savings Goal</p>
            <div class="stat-row">
                <h3 class="stat-value">{{ $savingsPercent === null ? 'N/A' : ($savingsPercent . '%') }}</h3>
                @php $sc = $savingsChange ?? null; @endphp
                <span class="stat-change {{ $sc['direction'] ?? 'neutral' }}">
                    @if(isset($sc['label']) && $sc['label'] === 'N/A') N/A
                    @elseif(isset($sc['label']) && $sc['label'] === 'New') New
                    @else {{ ($sc['label'] > 0 ? '+' : '') . ($sc['label'] ?? 0) . '%' }}
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="content-grid">
        <div class="content-card">
            <div class="card-header">
                <h3>Recent Transactions</h3>
            </div>
            <div class="transaction-list">
                @if(isset($recentTransactions) && $recentTransactions->count())
                    @foreach($recentTransactions as $t)
                        @php $date = \Illuminate\Support\Carbon::parse($t['transaction_date']); @endphp
                        <div class="transaction-item">
                            <div>
                                <p class="transaction-name">{{ $t['name'] }}</p>
                                <p class="transaction-date">{{ $date->format('M j') }}
                                    @if($t['category']) • <span style="color:#9ca3af;font-size:12px">{{ $t['category'] }}</span>@endif
                                </p>
                            </div>
                            @if($t['type'] === 'income')
                                <p class="transaction-amount income">&#8369;{{ number_format($t['amount'], 2) }}</p>
                            @else
                                <p class="transaction-amount expense">-&#8369;{{ number_format($t['amount'], 2) }}</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="transaction-item">
                        <div>
                            <p class="transaction-name">No recent transactions</p>
                            <p class="transaction-date">You haven't added any incomes or expenses yet.</p>
                        </div>
                        <p class="transaction-amount">&mdash;</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection