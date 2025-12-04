@extends('layouts.app')

@section('title', 'Analytics')

@push('styles')
<style>
    .analytics-wrapper {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto !important;
        padding: 2rem 1.5rem;
    }
    
    section.col-md-9 {
        max-width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        margin: 0 auto !important;
    }
    
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid #1f2937;
        background-color: #111827;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.3) !important;
    }
    
    .card-header {
        background-color: #111827;
        border-bottom: 1px solid #1f2937;
    }
    
    .card-body {
        background-color: #111827;
    }
    
    .summary-card {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        border: 1px solid #1f2937;
        border-radius: 12px;
        padding: 1.5rem;
        height: 100%;
    }
    
    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .badge-month {
        background-color: #1f2937;
        color: #9ca3af;
        padding: 0.375rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-center w-100">
    <div class="analytics-wrapper">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1 fw-bold text-white">Analytics Dashboard</h1>
            <p class="text-muted mb-0">Financial insights for {{ \Carbon\Carbon::create()->month($month)->format('F Y') }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-light btn-sm">
                <i class="bi bi-calendar-range me-2"></i>Change Period
            </button>
            <button class="btn btn-primary btn-sm">
                <i class="bi bi-download me-2"></i>Export
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Income</p>
                        <h3 class="mb-0 fw-bold text-success">₱{{ number_format($totalIncome ?? 0, 2) }}</h3>
                    </div>
                    <div class="icon-circle" style="background-color: rgba(16, 185, 129, 0.1);">
                        <i class="bi bi-arrow-up-circle text-success fs-4"></i>
                    </div>
                </div>
                <p class="text-success small mb-0 mt-2">
                    <i class="bi bi-graph-up-arrow me-1"></i>+12% from last month
                </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Expenses</p>
                        <h3 class="mb-0 fw-bold text-danger">₱{{ number_format($totalExpenses ?? 0, 2) }}</h3>
                    </div>
                    <div class="icon-circle" style="background-color: rgba(239, 68, 68, 0.1);">
                        <i class="bi bi-arrow-down-circle text-danger fs-4"></i>
                    </div>
                </div>
                <p class="text-danger small mb-0 mt-2">
                    <i class="bi bi-graph-down-arrow me-1"></i>-3% from last month
                </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Net Balance</p>
                        <h3 class="mb-0 fw-bold text-primary">₱{{ number_format(($totalIncome ?? 0) - ($totalExpenses ?? 0), 2) }}</h3>
                    </div>
                    <div class="icon-circle" style="background-color: rgba(59, 130, 246, 0.1);">
                        <i class="bi bi-wallet2 text-primary fs-4"></i>
                    </div>
                </div>
                <p class="text-primary small mb-0 mt-2">
                    <i class="bi bi-info-circle me-1"></i>Savings rate: 35%
                </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="summary-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Budget Status</p>
                        <h3 class="mb-0 fw-bold text-warning">78%</h3>
                    </div>
                    <div class="icon-circle" style="background-color: rgba(251, 191, 36, 0.1);">
                        <i class="bi bi-pie-chart text-warning fs-4"></i>
                    </div>
                </div>
                <div class="progress mt-2" style="height: 6px; background-color: #1f2937;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 78%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-3">
        <!-- Expenses by Category -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header border-0 pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold text-white">Expenses by Category</h5>
                        <span class="badge-month">{{ \Carbon\Carbon::create()->month($month)->format('M Y') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chart-expenses-by-category" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Income vs Expenses Trend -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header border-0 pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold text-white">Income vs Expenses</h5>
                        <span class="badge-month">Last 6 Months</span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chart-income-vs-expenses" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Budget Performance -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header border-0 pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold text-white">Budget Performance</h5>
                        <span class="badge-month">{{ \Carbon\Carbon::create()->month($month)->format('M Y') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chart-budget-performance" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Daily Net -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header border-0 pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold text-white">Daily Net Flow</h5>
                        <span class="badge-month">{{ \Carbon\Carbon::create()->month($month)->format('M Y') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chart-daily-net" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function(){
        const expensesByCategory = @json($expensesByCategory ?? ['labels' => [], 'data' => []]);
        const trend = @json($trend ?? ['labels' => [], 'income' => [], 'expenses' => []]);
        const budgetPerf = @json($budgetPerf ?? ['labels' => [], 'budgets' => [], 'spent' => []]);
        const daily = @json($daily ?? ['labels' => [], 'net' => []]);

        // Chart defaults for dark theme
        Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        Chart.defaults.color = '#9ca3af';
        
        // Modern color palette
        const colors = {
            primary: '#3b82f6',
            success: '#10b981',
            danger: '#ef4444',
            warning: '#fbbf24',
            info: '#06b6d4',
            purple: '#8b5cf6',
            pink: '#ec4899',
            gray: '#6b7280'
        };

        const categoryColors = [
            colors.primary, colors.success, colors.info, 
            colors.warning, colors.danger, colors.purple, 
            colors.pink, colors.gray
        ];

        // Expenses by category - Doughnut
        const ctx1 = document.getElementById('chart-expenses-by-category').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: expensesByCategory.labels || [],
                datasets: [{
                    data: expensesByCategory.data || [],
                    backgroundColor: categoryColors,
                    borderWidth: 2,
                    borderColor: '#111827'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: { size: 11 },
                            color: '#9ca3af'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#fff',
                        bodyColor: '#9ca3af',
                        borderColor: '#374151',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ₱${value.toLocaleString()} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Income vs Expenses trend - Line
        const ctx2 = document.getElementById('chart-income-vs-expenses').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: trend.labels || [],
                datasets: [
                    { 
                        label: 'Income', 
                        data: trend.income || [], 
                        borderColor: colors.success,
                        backgroundColor: colors.success + '20',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: colors.success,
                        pointBorderColor: '#111827'
                    },
                    { 
                        label: 'Expenses', 
                        data: trend.expenses || [], 
                        borderColor: colors.danger,
                        backgroundColor: colors.danger + '20',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: colors.danger,
                        pointBorderColor: '#111827'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            color: '#9ca3af'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#fff',
                        bodyColor: '#9ca3af',
                        borderColor: '#374151',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ₱' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#1f2937'
                        },
                        ticks: {
                            color: '#9ca3af',
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    }
                }
            }
        });

        // Budget performance - Bar
        const ctx3 = document.getElementById('chart-budget-performance').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: budgetPerf.labels || [],
                datasets: [
                    { 
                        label: 'Budget', 
                        data: budgetPerf.budgets || [], 
                        backgroundColor: colors.primary + 'cc',
                        borderRadius: 6
                    },
                    { 
                        label: 'Spent', 
                        data: budgetPerf.spent || [], 
                        backgroundColor: colors.danger + 'cc',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            color: '#9ca3af'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#fff',
                        bodyColor: '#9ca3af',
                        borderColor: '#374151',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ₱' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#1f2937'
                        },
                        ticks: {
                            color: '#9ca3af',
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    }
                }
            }
        });

        // Daily net - Bar with conditional colors
        const ctx4 = document.getElementById('chart-daily-net').getContext('2d');
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: daily.labels || [],
                datasets: [{
                    label: 'Daily Net',
                    data: daily.net || [],
                    backgroundColor: function(context) {
                        const value = context.parsed.y;
                        return value < 0 ? colors.danger + 'cc' : colors.success + 'cc';
                    },
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#fff',
                        bodyColor: '#9ca3af',
                        borderColor: '#374151',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed.y;
                                const prefix = value >= 0 ? '+' : '';
                                return 'Net: ' + prefix + '₱' + value.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#1f2937'
                        },
                        ticks: {
                            color: '#9ca3af',
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    }
                }
            }
        });
    })();
</script>
@endpush