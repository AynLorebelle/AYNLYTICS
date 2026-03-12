@extends('layouts.app')

@section('title', 'Analytics')

@push('styles')
<style>
    /* Layout wrapper */
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

    .ui-card {
        display: block;
        background-color: #0f1724;
        border: 1px solid #1f2937;
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
        height: 360px;
    }

    .ui-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 0.75rem 1.5rem rgba(2,6,23,0.6);
    }

    .ui-card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(31,41,55,0.6);
        padding: 0.75rem 1rem;
    }

    .ui-card-header .title {
        margin: 0;
        font-weight: 600;
        color: #ffffff;
    }

    .ui-card-body {
        display: block;
        padding: 0.75rem 1rem;
        background-color: transparent;
    }

    .summary-card {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        border: 1px solid #1f2937;
        border-radius: 12px;
        padding: 1.25rem;
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

    .chart-container {
        position: relative;
        height: 260px;
        width: 100%;
    }

    .chart-container.doughnut {
        height: 320px;
    }

    .chart-container canvas {
        display: block;
        width: 100% !important;
        height: 100% !important;
    }

    .text-white { color: #fff; }
    .text-light { color: #cbd5e1; }
    .fw-semibold { font-weight: 600; }
    .fw-bold { font-weight: 700; }
    .small { font-size: 0.85rem; }

    /* Export dropdown styles */
    .export-dropdown {
        position: relative;
        display: inline-block;
    }

    .export-dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 0.5rem;
        background-color: #1f2937;
        border: 1px solid #374151;
        border-radius: 0.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        min-width: 200px;
        z-index: 1000;
        display: none;
    }

    .export-dropdown-menu.show {
        display: block;
    }

    .export-dropdown-item {
        padding: 0.75rem 1rem;
        color: #e5e7eb;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        transition: background-color 0.2s;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        font-size: 0.875rem;
    }

    .export-dropdown-item:hover {
        background-color: #374151;
    }

    .export-dropdown-item:first-child {
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .export-dropdown-item:last-child {
        border-radius: 0 0 0.5rem 0.5rem;
    }

    .export-dropdown-divider {
        height: 1px;
        background-color: #374151;
        margin: 0.25rem 0;
    }

    /* Loading overlay */
    .export-loading {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .export-loading.show {
        display: flex;
    }

    .export-loading-content {
        background-color: #1f2937;
        padding: 2rem;
        border-radius: 1rem;
        text-align: center;
        border: 1px solid #374151;
    }

    .export-spinner {
        border: 4px solid #374151;
        border-top: 4px solid #3b82f6;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Month picker modal */
    .period-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        align-items: center;
        justify-content: center;
    }

    .period-modal.show {
        display: flex;
    }

    .period-modal-content {
        background-color: #1f2937;
        border: 1px solid #374151;
        border-radius: 1rem;
        padding: 2rem;
        width: 90%;
        max-width: 500px;
        position: relative;
    }

    .period-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .period-modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .period-modal-close {
        background: none;
        border: none;
        color: #9ca3af;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        transition: background-color 0.2s;
    }

    .period-modal-close:hover {
        background-color: #374151;
    }

    .period-selector {
        display: grid;
        gap: 1rem;
    }

    .period-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group label {
        display: block;
        color: #9ca3af;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.75rem;
        background-color: #111827;
        border: 1px solid #374151;
        border-radius: 0.5rem;
        color: #fff;
        font-size: 0.875rem;
        transition: border-color 0.2s;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .period-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .btn-apply {
        flex: 1;
        padding: 0.75rem;
        background-color: #3b82f6;
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-apply:hover {
        background-color: #2563eb;
    }

    .btn-cancel {
        flex: 1;
        padding: 0.75rem;
        background-color: transparent;
        color: #9ca3af;
        border: 1px solid #374151;
        border-radius: 0.5rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background-color: #374151;
        color: #fff;
    }

    .quick-select {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .quick-select-btn {
        padding: 0.5rem 1rem;
        background-color: #111827;
        color: #9ca3af;
        border: 1px solid #374151;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .quick-select-btn:hover,
    .quick-select-btn.active {
        background-color: #3b82f6;
        color: #fff;
        border-color: #3b82f6;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-center w-100">
    <div class="analytics-wrapper" id="analytics-report">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mb-1 fw-bold text-white">Analytics Report</h1>
                <p class="text-light mb-0">Financial insights for <span id="currentDate"></span></p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-light btn-sm" onclick="openPeriodModal()">
                    <i class="bi bi-calendar-range me-2"></i>Change Period
                </button>
                <div class="export-dropdown">
                    <button class="btn btn-primary btn-sm" id="exportButton">
                        <i class="bi bi-download me-2"></i>Export
                    </button>
                    <div class="export-dropdown-menu" id="exportMenu">
                        <button class="export-dropdown-item" onclick="exportAsPDF()">
                            <i class="bi bi-file-pdf"></i>
                            <span>Export as PDF</span>
                        </button>
                        <button class="export-dropdown-item" onclick="exportAsPNG()">
                            <i class="bi bi-file-image"></i>
                            <span>Export as PNG</span>
                        </button>
                        <div class="export-dropdown-divider"></div>
                        <button class="export-dropdown-item" onclick="exportChartsOnly()">
                            <i class="bi bi-bar-chart"></i>
                            <span>Export Charts Only</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-3 mb-4" id="summary-cards">
            <div class="col-md-6 col-lg-3">
                <div class="summary-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-light mb-1 small">Total Income</p>
                            <h3 class="mb-0 fw-bold text-success">₱{{ number_format($totalIncome ?? 0, 2) }}</h3>
                        </div>
                        <div class="icon-circle" style="background-color: rgba(16, 185, 129, 0.1);">
                            <i class="bi bi-arrow-up-circle text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="summary-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-light mb-1 small">Total Expenses</p>
                            <h3 class="mb-0 fw-bold text-danger">₱{{ number_format($totalExpenses ?? 0, 2) }}</h3>
                        </div>
                        <div class="icon-circle" style="background-color: rgba(239, 68, 68, 0.1);">
                            <i class="bi bi-arrow-down-circle text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="summary-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-light mb-1 small">Net Balance</p>
                            <h3 class="mb-0 fw-bold text-primary">₱{{ number_format(($totalIncome ?? 0) - ($totalExpenses ?? 0), 2) }}</h3>
                        </div>
                        <div class="icon-circle" style="background-color: rgba(59, 130, 246, 0.1);">
                            <i class="bi bi-wallet2 text-primary fs-4"></i>
                        </div>
                    </div>
                    <p class="text-primary small mb-0 mt-2">
                        <i class="bi bi-info-circle me-1"></i>Savings rate: {{ $savingsRate ?? 0 }}%
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="summary-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-light mb-1 small">Budget Status</p>
                            <h3 class="mb-0 fw-bold text-warning">{{ $budgetUsagePercent ?? 0 }}%</h3>
                        </div>
                        <div class="icon-circle" style="background-color: rgba(251, 191, 36, 0.1);">
                            <i class="bi bi-pie-chart text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 6px; background-color: #1f2937;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $budgetUsagePercent ?? 0 }}%;" aria-valuenow="{{ $budgetUsagePercent ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-3">
            <!-- Expenses by Category -->
            <div class="col-lg-6">
                <div class="ui-card">
                    <div class="ui-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="title mb-0">Expenses by Category</h5>
                            <span class="badge-month">{{ $periodLabel ?? now()->format('M Y') }}</span>
                        </div>
                    </div>
                    <div class="ui-card-body">
                        <div class="chart-container doughnut">
                            <canvas id="chart-expenses-by-category"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Income vs Expenses Trend -->
            <div class="col-lg-6">
                <div class="ui-card">
                    <div class="ui-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="title mb-0">Income vs Expenses</h5>
                            <span class="badge-month">Last 6 Months</span>
                        </div>
                    </div>
                    <div class="ui-card-body">
                        <div class="chart-container">
                            <canvas id="chart-income-vs-expenses"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Budget Performance -->
            <div class="col-lg-6">
                <div class="ui-card">
                    <div class="ui-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="title mb-0">Budget Performance</h5>
                            <span class="badge-month">{{ $periodLabel ?? now()->format('M Y') }}</span>
                        </div>
                    </div>
                    <div class="ui-card-body">
                        <div class="chart-container">
                            <canvas id="chart-budget-performance"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Net -->
            <div class="col-lg-6">
                <div class="ui-card">
                    <div class="ui-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="title mb-0">Daily Net Flow</h5>
                            <span class="badge-month">{{ $periodLabel ?? now()->format('M Y') }}</span>
                        </div>
                    </div>
                    <div class="ui-card-body">
                        <div class="chart-container">
                            <canvas id="chart-daily-net"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Period Selection Modal -->
<div class="period-modal" id="periodModal">
    <div class="period-modal-content">
        <div class="period-modal-header">
            <h3 class="period-modal-title">Select Period</h3>
            <button class="period-modal-close" onclick="closePeriodModal()">&times;</button>
        </div>
        
        <div class="quick-select">
            <button class="quick-select-btn" onclick="selectQuickPeriod('current', this)">This Month</button>
            <button class="quick-select-btn" onclick="selectQuickPeriod('last', this)">Last Month</button>
            <button class="quick-select-btn" onclick="selectQuickPeriod('last3', this)">Last 3 Months</button>
            <button class="quick-select-btn" onclick="selectQuickPeriod('last6', this)">Last 6 Months</button>
            <button class="quick-select-btn" onclick="selectQuickPeriod('last12', this)">Last 12 Months</button>
        </div>

        <div class="period-selector">
            <div class="period-row">
                <div class="form-group">
                    <label>From Month</label>
                    <input type="month" id="fromMonth" class="form-control-custom" value="{{ $fromMonth ?? '' }}">
                </div>
                <div class="form-group">
                    <label>To Month</label>
                    <input type="month" id="toMonth" class="form-control-custom" value="{{ $toMonth ?? '' }}">
                </div>
            </div>
        </div>

        <div class="period-actions">
            <button class="btn-cancel" onclick="closePeriodModal()">Cancel</button>
            <button class="btn-apply" onclick="applyPeriodFilter()">Apply Filter</button>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="export-loading" id="exportLoading">
    <div class="export-loading-content">
        <div class="export-spinner"></div>
        <p class="text-white mb-0">Generating export...</p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    let chartInstances = {};

    (function(){
        // Server-side JSON -> JS objects
        const expensesByCategory = @json($expensesByCategory ?? ['labels' => [], 'data' => []]);
        const trend = @json($trend ?? ['labels' => [], 'income' => [], 'expenses' => []]);
        const budgetPerf = @json($budgetPerf ?? ['labels' => [], 'budgets' => [], 'spent' => []]);
        const daily = @json($daily ?? ['labels' => [], 'net' => []]);

        // Chart defaults for dark theme
        Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        Chart.defaults.color = '#9ca3af';

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

        // Helper: create repeated color array matching length
        function getColorsForCount(count) {
            const palette = [];
            for (let i = 0; i < count; i++) {
                palette.push(categoryColors[i % categoryColors.length]);
            }
            return palette;
        }

        // ---------- Expenses by category (doughnut) ----------
        try {
            const ctx1 = document.getElementById('chart-expenses-by-category').getContext('2d');
            const bgColors = getColorsForCount((expensesByCategory.data || []).length);
            chartInstances.expensesByCategory = new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: expensesByCategory.labels || [],
                    datasets: [{
                        data: expensesByCategory.data || [],
                        backgroundColor: bgColors,
                        borderWidth: 2,
                        borderColor: '#0f1724'
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
                                    const percentage = total ? ((value / total) * 100).toFixed(1) : 0;
                                    return `${label}: ₱${Number(value).toLocaleString()} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        } catch (e) {
            console.error('Failed to init expensesByCategory chart', e);
        }

        // ---------- Income vs Expenses (line) ----------
        try {
            const ctx2 = document.getElementById('chart-income-vs-expenses').getContext('2d');
            chartInstances.incomeVsExpenses = new Chart(ctx2, {
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
                    interaction: { mode: 'index', intersect: false },
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
                                    const value = context.parsed && context.parsed.y !== undefined ? context.parsed.y : context.parsed;
                                    return context.dataset.label + ': ₱' + Number(value || 0).toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#1f2937' },
                            ticks: {
                                color: '#9ca3af',
                                callback: function(value) { return '₱' + value.toLocaleString(); }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#9ca3af' }
                        }
                    }
                }
            });
        } catch (e) {
            console.error('Failed to init incomeVsExpenses chart', e);
        }

        // ---------- Budget Performance (bar) ----------
        try {
            const ctx3 = document.getElementById('chart-budget-performance').getContext('2d');
            const bpLabels = budgetPerf.labels || [];
            const budgets = budgetPerf.budgets || [];
            const spent = budgetPerf.spent || [];
            const barColors = getColorsForCount(bpLabels.length);

            chartInstances.budgetPerformance = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: bpLabels,
                    datasets: [
                        { label: 'Budget', data: budgets, backgroundColor: barColors.map(c => c + '33'), borderColor: barColors, borderWidth: 1 },
                        { label: 'Spent', data: spent, backgroundColor: barColors.map(c => c + '99'), borderColor: barColors, borderWidth: 1 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { color: '#9ca3af' } },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleColor: '#fff',
                            bodyColor: '#9ca3af',
                            borderColor: '#374151',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context){
                                    const value = context.parsed.y !== undefined ? context.parsed.y : context.parsed;
                                    return context.dataset.label + ': ₱' + Number(value || 0).toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { color: '#9ca3af', callback: v => '₱' + v.toLocaleString() }, grid: { color: '#1f2937' } },
                        x: { ticks: { color: '#9ca3af' }, grid: { display: false } }
                    }
                }
            });
        } catch (e) {
            console.error('Failed to init budgetPerformance chart', e);
        }

        // ---------- Daily Net Flow (line) ----------
        try {
            const ctx4 = document.getElementById('chart-daily-net').getContext('2d');
            chartInstances.dailyNet = new Chart(ctx4, {
                type: 'line',
                data: {
                    labels: daily.labels || [],
                    datasets: [{
                        label: 'Daily Net',
                        data: daily.net || [],
                        borderColor: colors.primary,
                        backgroundColor: colors.primary + '20',
                        fill: true,
                        tension: 0.2,
                        borderWidth: 2,
                        pointRadius: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleColor: '#fff',
                            bodyColor: '#9ca3af',
                            borderColor: '#374151',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed && context.parsed.y !== undefined ? context.parsed.y : context.parsed;
                                    return '₱' + Number(value || 0).toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { color: '#9ca3af', callback: v => '₱' + v.toLocaleString() }, grid: { color: '#1f2937' } },
                        x: { ticks: { color: '#9ca3af' }, grid: { display: false } }
                    }
                }
            });
        } catch (e) {
            console.error('Failed to init dailyNet chart', e);
        }
    })();

    // ----------------- Period header -----------------
    const fromMonth = "{{ $fromMonth ?? '' }}";
    const toMonth = "{{ $toMonth ?? '' }}";

    if (fromMonth && toMonth) {
        try {
            const from = new Date(fromMonth + '-01');
            const to = new Date(toMonth + '-01');

            if (fromMonth === toMonth) {
                document.getElementById('currentDate').textContent = from.toLocaleString('default', { month: 'long', year: 'numeric' });
            } else {
                const fromStr = from.toLocaleString('default', { month: 'short', year: 'numeric' });
                const toStr = to.toLocaleString('default', { month: 'short', year: 'numeric' });
                document.getElementById('currentDate').textContent = `${fromStr} - ${toStr}`;
            }
        } catch (e) {
            document.getElementById('currentDate').textContent = new Date().toLocaleString('default', { month: 'long', year: 'numeric' });
        }
    } else {
        document.getElementById('currentDate').textContent = new Date().toLocaleString('default', { month: 'long', year: 'numeric' });
    }

    // ----------------- Period modal functions -----------------
    function openPeriodModal() {
        const modal = document.getElementById('periodModal');
        modal.classList.add('show');

        const now = new Date();
        const currentMonth = now.toISOString().slice(0, 7);

        if (!document.getElementById('fromMonth').value) {
            document.getElementById('fromMonth').value = currentMonth;
        }
        if (!document.getElementById('toMonth').value) {
            document.getElementById('toMonth').value = currentMonth;
        }
    }

    function closePeriodModal() {
        const modal = document.getElementById('periodModal');
        modal.classList.remove('show');
    }

    // pass `this` from the onclick to reliably highlight
    function selectQuickPeriod(period, el) {
        const now = new Date();
        let fromDate, toDate;

        switch(period) {
            case 'current':
                fromDate = new Date(now.getFullYear(), now.getMonth(), 1);
                toDate = now;
                break;
            case 'last':
                fromDate = new Date(now.getFullYear(), now.getMonth() - 1, 1);
                toDate = new Date(now.getFullYear(), now.getMonth(), 0);
                break;
            case 'last3':
                fromDate = new Date(now.getFullYear(), now.getMonth() - 2, 1);
                toDate = now;
                break;
            case 'last6':
                fromDate = new Date(now.getFullYear(), now.getMonth() - 5, 1);
                toDate = now;
                break;
            case 'ytd':
                fromDate = new Date(now.getFullYear(), 0, 1);
                toDate = now;
                break;
            default:
                fromDate = new Date(now.getFullYear(), now.getMonth(), 1);
                toDate = now;
        }

        document.getElementById('fromMonth').value = fromDate.toISOString().slice(0, 7);
        document.getElementById('toMonth').value = toDate.toISOString().slice(0, 7);

        document.querySelectorAll('.quick-select-btn').forEach(btn => btn.classList.remove('active'));
        if (el && el.classList) el.classList.add('active');
    }

    function applyPeriodFilter() {
        const fromMonthVal = document.getElementById('fromMonth').value;
        const toMonthVal = document.getElementById('toMonth').value;

        if (!fromMonthVal || !toMonthVal) {
            alert('Please select both from and to months');
            return;
        }

        if (fromMonthVal > toMonthVal) {
            alert('From month cannot be after to month');
            return;
        }

        // Show loading
        showLoading();

        // Redirect with 'from' and 'to' params (YYYY-MM)
        const url = new URL(window.location.href);
        url.searchParams.set('from', fromMonthVal);
        url.searchParams.set('to', toMonthVal);
        window.location.href = url.toString();
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('periodModal');
        if (modal && e.target === modal) {
            closePeriodModal();
        }
    });

    // Export dropdown toggle
    document.getElementById('exportButton').addEventListener('click', function(e) {
        e.stopPropagation();
        const menu = document.getElementById('exportMenu');
        menu.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.querySelector('.export-dropdown');
        const menu = document.getElementById('exportMenu');
        if (!dropdown.contains(e.target)) {
            menu.classList.remove('show');
        }
    });

    // Exports (unchanged except kept here for context)
    function showLoading() {
        document.getElementById('exportLoading').classList.add('show');
        const menu = document.getElementById('exportMenu');
        if (menu) menu.classList.remove('show');
    }

    function hideLoading() {
        document.getElementById('exportLoading').classList.remove('show');
    }

    async function exportAsPDF() {
        showLoading();

        try {
            const element = document.getElementById('analytics-report');
            const canvas = await html2canvas(element, {
                scale: 2,
                backgroundColor: '#020617',
                logging: false,
                useCORS: true
            });

            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            const imgWidth = 210;
            const pageHeight = 297;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;
            let position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            const fileName = `Analytics_Report_${new Date().toISOString().split('T')[0]}.pdf`;
            pdf.save(fileName);
        } catch (error) {
            console.error('Export failed:', error);
            alert('Export failed. Please try again.');
        } finally {
            hideLoading();
        }
    }

    async function exportAsPNG() {
        showLoading();

        try {
            const element = document.getElementById('analytics-report');
            const canvas = await html2canvas(element, {
                scale: 2,
                backgroundColor: '#020617',
                logging: false,
                useCORS: true
            });

            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                const fileName = `Analytics_Report_${new Date().toISOString().split('T')[0]}.png`;
                link.download = fileName;
                link.href = url;
                link.click();
                URL.revokeObjectURL(url);
                hideLoading();
            });
        } catch (error) {
            console.error('Export failed:', error);
            alert('Export failed. Please try again.');
            hideLoading();
        }
    }

    async function exportChartsOnly() {
        showLoading();

        try {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            const charts = [
                { id: 'chart-expenses-by-category', title: 'Expenses by Category' },
                { id: 'chart-income-vs-expenses', title: 'Income vs Expenses' },
                { id: 'chart-budget-performance', title: 'Budget Performance' },
                { id: 'chart-daily-net', title: 'Daily Net Flow' }
            ];

            for (let i = 0; i < charts.length; i++) {
                if (i > 0) pdf.addPage();

                const canvas = document.getElementById(charts[i].id);
                const imgData = canvas.toDataURL('image/png');

                // Add title
                pdf.setFontSize(16);
                pdf.setTextColor(255, 255, 255);
                pdf.text(charts[i].title, 105, 20, { align: 'center' });

                // Add chart image
                const imgWidth = 180;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, 'PNG', 15, 30, imgWidth, imgHeight);
            }

            const fileName = `Analytics_Charts_${new Date().toISOString().split('T')[0]}.pdf`;
            pdf.save(fileName);
        } catch (error) {
            console.error('Export failed:', error);
            alert('Export failed. Please try again.');
        } finally {
            hideLoading();
        }
    }
</script>
@endpush
