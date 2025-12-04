
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aynlytics - Financial Planner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0a1628;
            color: #ffffff;
            min-height: 100vh;
        }
        
        .header {
            border-bottom: 1px solid #1f2937;
            background-color: #0a1e36;
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 10px 0;
        }
        
        .header-container {
            max-width: 110%;  
            margin: 0;        
            padding: 10px 20px;  
        }
                
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
             width: 100%;
        }
          /* Header actions container */
        .header-actions {
            display: flex;
            align-items: center;
            margin-left: auto;
            padding-right: 20px;  
            
        }

        /* Individual icon buttons */
        .header-icon {
            position: relative;
            padding: 8px;
            color: #ffffffff;
            background: transparent;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 50px;
            
            
        }

        .header-icon:hover {
            box-shadow: 
                0 15px 40px rgba(232, 244, 77, 0.6),
                0 0 0 2px rgba(232, 244, 77, 0.4);
            background: transparent;
        }


        .header-icon .icon {
            width: 24px;
            height: 24px;
        }

        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 100px;
            margin-left: 0px;
            margin-top: 0px;
            padding: 0px;
        }
        
        .logo-icon {
            width: 130px;
            height: 130px;
            background: transparent;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            margin-left: 40px;
        }
        .logo-icon img {
            width: 100%;
            height: auto;
            object-fit: contain;

        }
        
        .logo-text h1 {
            font-size: 20px;
            font-weight: bold;
            color: #d4a574;
            letter-spacing: 0.05em;
        }
        
        .logo-text p {
            font-size: 12px;
            color: #9ca3af;
        }
        

        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background-color: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 10px;
            min-width: 16px;
            text-align: center;
        }
        
        .menu-open {
            position: fixed;           
            right: 20px;                  
            top: 115px;                    
            height: calc(100vh- 84px);             
            width: 250px;              
            border-right: 1px solid #1f2937;  
            background-color: #0a1628;
            padding: 16px 12px;       
            display: flex;
            flex-direction: column;
            align-items: stretch;      
            overflow-y: auto;          
            z-index: 100;   
        }
        
        .menu-nav {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 0;
            gap: 8px;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 8px;
            background-color: transparent;
            color: #9ca3af;
            border: none;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
            text-align: left;
            transition: all 0.2s;
            text-align: left;  
        }
        
        .menu-item:hover {
            background-color: #1f2937;
            color: white;
        }
        
        .menu-item.active {
            background-color: #2563eb;
            color: white;
        }
        
        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 32px 24px;
        }
        
        .welcome-section {
            margin-bottom: 32px;
        }
        
        .welcome-section h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .welcome-section p {
            color: #9ca3af;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        
        .stat-card {
            background-color: #111827;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #1f2937;
        }
        
        .stat-label {
            color: #9ca3af;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .stat-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: white;
        }
        
        .stat-change {
            font-size: 14px;
            font-weight: 500;
        }
        
        .stat-change.positive {
            color: #10b981;
        }
        
        .stat-change.negative {
            color: #ef4444;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .content-card {
            background-color: #111827;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #1f2937;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .card-header h3 {
            font-size: 20px;
            font-weight: bold;
        }
        
        .btn-primary {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        
        .transaction-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background-color: #0a1628;
            border-radius: 8px;
            border: 1px solid #1f2937;
        }
        
        .transaction-name {
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .transaction-date {
            font-size: 14px;
            color: #9ca3af;
        }
        
        .transaction-amount {
            font-weight: bold;
            font-size: 18px;
        }
        
        .transaction-amount.income {
            color: #10b981;
        }
        
        .transaction-amount.expense {
            color: #ef4444;
        }
        
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        
        .action-button {
            background-color: #0a1628;
            border: 2px solid;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .action-button:hover {
            transform: translateY(-2px);
        }
        
        .action-button span {
            font-size: 14px;
            font-weight: 500;
        }
        
        .icon {
            width: 18px;
            height: 18px;
        }
        
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-content">
                <div class="logo-section">
                    <div class="logo-icon"><img src="{{ asset('build/image/2.svg') }}" alt=""></div>
                    <div class="logo-text">
                        <h1> </h1>
                        <p></p>
                    </div>
            
                </div>

                <div class="header-actions">
                 <button class="header-icon" onclick="toggleProfile()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                </path>
            </svg>
        </button>

                <button class="header-icon " onclick="toggleNotifications()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            <!-- Optional: Notification badge -->
            <span class="notification-badge">3</span>
        </button>

                <button class="header-icon menu " onclick="toggleMenu()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>
            </div>
        </div>

        <div id="menu" class="menu-open hidden">
            <nav class="menu-nav">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z">
        </path>
    </svg>
    <span>Dashboard</span>
</a>
                <!-- Set Goals -->
    <a class="nav-link menu-item" 
       href="" 
       onclick="setActive(1)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>Set Goals</span>
    </a>

    <!-- Analytics -->
    <a class="nav-link menu-item" 
       href="" 
       onclick="setActive(2)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
        </svg>
        <span>Analytics</span>
    </a>

    <!-- Budget -->
    <a class="nav-link menu-item" 
       href="{{ route('budgets.index') }}" 
       onclick="setActive(3)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>Budget</span>
    </a>

    <!-- Expenses -->
    <a class="nav-link menu-item" 
       href="{{ route('expenses.index') }}" 
       onclick="setActive(4)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l6 6 4-4 8 8"/>
        </svg>
        <span>Expenses</span>
    </a>

    <!-- Categories -->
    <a class="nav-link menu-item" 
       href="{{ route('categories.index') }}" 
       onclick="setActive(5)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M3 11l8.586 8.586a2 2 0 002.828 0L21 13l-8-8H5a2 2 0 00-2 2v4z"/>
        </svg>
        <span>Categories</span>
    </a>

    <!-- Income -->
    <a class="nav-link menu-item" 
       href="{{ route('incomes.index') }}" 
       onclick="setActive(6)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>Income</span>
    </a>
    <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
    </svg>
    <span>Edit Profile</span>
</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="welcome-section">
            <h2>Welcome back</h2>
            <p>Here's what's happening with your finances today.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <p class="stat-label">Budget</p>
                <div class="stat-row">
                    <h3 class="stat-value">&#8369;{{ number_format($totalBudgets ?? 0,2) }}</h3>
                    @php $b = $budgetChange ?? null; @endphp
                    <span class="stat-change {{ $b['direction'] ?? 'neutral' }}">
                        @if(isset($b['label']) && $b['label'] === 'N/A')
                            N/A
                        @elseif(isset($b['label']) && $b['label'] === 'New')
                            New
                        @else
                            {{ ($b['label'] > 0 ? '+' : '') . ($b['label'] ?? 0) . '%' }}
                        @endif
                    </span>
                </div>
            </div>
            <div class="stat-card">
                <p class="stat-label">Monthly Income</p>
                <div class="stat-row">
                    <h3 class="stat-value">&#8369;{{ number_format($totalIncomes ?? 0,2) }}</h3>
                    @php $ic = $incomeChange ?? null; @endphp
                    <span class="stat-change {{ $ic['direction'] ?? 'neutral' }}">
                        @if(isset($ic['label']) && $ic['label'] === 'N/A')
                            N/A
                        @elseif(isset($ic['label']) && $ic['label'] === 'New')
                            New
                        @else
                            {{ ($ic['label'] > 0 ? '+' : '') . ($ic['label'] ?? 0) . '%' }}
                        @endif
                    </span>
                </div>
            </div>
            <div class="stat-card">
                <p class="stat-label">Expenses</p>
                <div class="stat-row">
                    <h3 class="stat-value">&#8369;{{ number_format($totalExpenses ?? 0,2) }}</h3>
                    @php $ec = $expenseChange ?? null; @endphp
                    <span class="stat-change {{ $ec['direction'] ?? 'neutral' }}">
                        @if(isset($ec['label']) && $ec['label'] === 'N/A')
                            N/A
                        @elseif(isset($ec['label']) && $ec['label'] === 'New')
                            New
                        @else
                            {{ ($ec['label'] > 0 ? '+' : '') . ($ec['label'] ?? 0) . '%' }}
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
                        @if(isset($sc['label']) && $sc['label'] === 'N/A')
                            N/A
                        @elseif(isset($sc['label']) && $sc['label'] === 'New')
                            New
                        @else
                            {{ ($sc['label'] > 0 ? '+' : '') . ($sc['label'] ?? 0) . '%' }}
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3>Recent Transactions</h3>
                    <button class="btn-primary">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New
                    </button>
                </div>
                
                <div class="transaction-list">
                    @if(isset($recentTransactions) && $recentTransactions->count())
                        @foreach($recentTransactions as $t)
                            @php $date = \Illuminate\Support\Carbon::parse($t['transaction_date']); @endphp
                            <div class="transaction-item">
                                <div>
                                    <p class="transaction-name">{{ $t['name'] }}</p>
                                    <p class="transaction-date">{{ $date->format('M j') }} @if($t['category']) • <span style="color:#9ca3af;font-size:12px">{{ $t['category'] }}</span>@endif</p>
                                </div>
                                @if($t['type'] === 'income')
                                    <p class="transaction-amount income">&#8369;{{ number_format($t['amount'],2) }}</p>
                                @else
                                    <p class="transaction-amount expense">-&#8369;{{ number_format($t['amount'],2) }}</p>
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

            <div class="content-card" id="charts-area">
                <div class="card-header">
                    <h3>Insights</h3>
                </div>

                <div class="charts-grid" style="display:grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                    <!-- Expenses by Category -->
                    <div class="chart-panel" id="panel-expense-category" style="background:#071a2b; border-radius:12px; padding:16px; border:1px solid rgba(255,255,255,0.03);">
                        <div class="card-header" style="margin-bottom:8px; align-items:center;">
                            <h3 style="font-size:16px;">Expenses by category — {{ now()->format('F Y') }}</h3>
                            <div style="margin-left:auto; color:#9ca3af; font-size:12px;">Click a slice for details</div>
                        </div>
                        <div style="min-height:260px; display:flex; align-items:center; justify-content:center;">
                            <div class="loader" data-target="#expenseCategoryChart">Loading...</div>
                            <canvas id="expenseCategoryChart" style="width:100%; max-width:420px; display:none"></canvas>
                        </div>
                        <div id="expenseCategoryLegend" style="margin-top:10px; display:flex; gap:8px; flex-wrap:wrap"></div>
                    </div>

                    <!-- Income vs Expenses Trend -->
                    <div class="chart-panel" id="panel-trend" style="background:#071a2b; border-radius:12px; padding:16px; border:1px solid rgba(255,255,255,0.03);">
                        <div class="card-header" style="margin-bottom:8px; align-items:center;">
                            <h3 style="font-size:16px;">Income vs Expenses — Last 6 months</h3>
                            <div style="margin-left:auto; color:#9ca3af; font-size:12px;">Income (green) • Expenses (red) • Balance (blue)</div>
                        </div>
                        <div style="min-height:260px; display:flex; align-items:center;">
                            <div class="loader" data-target="#incomeTrendChart">Loading...</div>
                            <canvas id="incomeTrendChart" style="display:none; width:100%"></canvas>
                        </div>
                    </div>

                    <!-- Budget Performance -->
                    <div class="chart-panel" id="panel-budget" style="background:#071a2b; border-radius:12px; padding:16px; border:1px solid rgba(255,255,255,0.03);">
                        <div class="card-header" style="margin-bottom:8px; align-items:center;">
                            <h3 style="font-size:16px;">Budget performance — {{ now()->format('F Y') }}</h3>
                            <div style="margin-left:auto; color:#9ca3af; font-size:12px;">Budget vs Spent (per category)</div>
                        </div>
                        <div style="min-height:260px; display:flex; align-items:center;">
                            <div class="loader" data-target="#budgetChart">Loading...</div>
                            <canvas id="budgetChart" style="display:none; width:100%"></canvas>
                        </div>
                    </div>

                    <!-- Monthly Spending Trend -->
                    <div class="chart-panel" id="panel-daily" style="background:#071a2b; border-radius:12px; padding:16px; border:1px solid rgba(255,255,255,0.03);">
                        <div class="card-header" style="margin-bottom:8px; align-items:center;">
                            <h3 style="font-size:16px;">Daily spending — {{ now()->format('F Y') }}</h3>
                            <div style="margin-left:auto; color:#9ca3af; font-size:12px;">Cumulative & daily trend</div>
                        </div>
                        <div style="min-height:260px; display:flex; align-items:center;">
                            <div class="loader" data-target="#dailyChart">Loading...</div>
                            <canvas id="dailyChart" style="display:none; width:100%"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        }

        function setActive(index) {
            const items = document.querySelectorAll('.menu-item');
            items.forEach((item, i) => {
                if (i === index) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
            toggleMenu();
        }    
    </script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Small helper: format currency
        function fmt(amount) {
            if (amount === null || amount === undefined) return '₱0.00';
            return '₱' + Number(amount).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }

        // Helper: show / hide loading
        function showLoaded(canvasId) {
            const canvas = document.querySelector(canvasId);
            if (!canvas) return;
            const loader = document.querySelector('.loader[data-target="'+canvasId+'"]');
            if (loader) loader.style.display = 'none';
            canvas.style.display = 'block';
        }

        async function loadDashboardCharts() {
            try {
                const res = await fetch('/app/dashboard/charts');
                if (!res.ok) throw new Error('Failed to fetch charts data');
                const data = await res.json();

                // COLORS per brand
                const PRIMARY = '#caa739';
                const SECONDARY = '#08b0d1';
                const SUCCESS = '#26a69a';
                const DANGER = '#ef4444';
                const PANEL = '#0b2738';

                // ---- EXPENSES BY CATEGORY (doughnut) ----
                (function(){
                    const meta = data.expenses_by_category || [];
                    const labels = meta.map(m => m.label);
                    const values = meta.map(m => m.value);
                    const colors = meta.map(m => m.color || SECONDARY);

                    const ctx = document.getElementById('expenseCategoryChart');
                    if (!ctx) return;
                    showLoaded('#expenseCategoryChart');

                    const doughnut = new Chart(ctx, {
                        type: 'doughnut',
                        data: { labels, datasets: [{ data: values, backgroundColor: colors, borderWidth: 1 }] },
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: ctx => `${ctx.label}: ${fmt(ctx.raw)} (${(ctx.raw / values.reduce((a,b)=>a+b,0) * 100).toFixed(1)}%)`
                                    }
                                },
                                legend: { display: false }
                            },
                            onClick(evt, elements) {
                                if (!elements.length) return;
                                const idx = elements[0].index;
                                const item = meta[idx];
                                alert(`${item.label}\nAmount: ${fmt(item.value)}\n${item.percent}% of month\nClick view details in Categories/Expenses to dig deeper.`);
                            }
                        }
                    });

                    // build legend
                    const legend = document.getElementById('expenseCategoryLegend');
                    if (legend) {
                        legend.innerHTML = '';
                        meta.forEach(m => {
                            const el = document.createElement('div');
                            el.style.display = 'flex'; el.style.alignItems = 'center'; el.style.gap='8px'; el.style.margin='4px';
                            el.innerHTML = `<div style="width:10px;height:10px;background:${m.color};border-radius:2px"></div><div style='font-size:12px;color:#cbd5e1;'>${m.label}: ${fmt(m.value)} (${m.percent}%)</div>`;
                            legend.appendChild(el);
                        })
                    }
                })();

                // ---- INCOME VS EXPENSES TREND (line + balance) ----
                (function(){
                    const labels = data.trend.labels || [];
                    const incomes = data.trend.income || [];
                    const expenses = data.trend.expenses || [];
                    const balances = data.trend.balance || [];

                    const ctx = document.getElementById('incomeTrendChart');
                    if (!ctx) return;
                    showLoaded('#incomeTrendChart');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [
                                { label: 'Income', data: incomes, borderColor: SUCCESS, backgroundColor:'rgba(38,166,154,0.12)', tension:0.3, fill:false },
                                { label: 'Expenses', data: expenses, borderColor: DANGER, backgroundColor:'rgba(239,68,68,0.08)', tension:0.3, fill:false },
                                { label: 'Balance', data: balances, borderColor: SECONDARY, backgroundColor:'rgba(8,176,209,0.06)', tension:0.3, borderDash:[5,5], fill:false }
                            ]
                        },
                        options: {
                            responsive:true,
                            plugins: { tooltip: { callbacks: { label(ctx){ return `${ctx.dataset.label}: ${fmt(ctx.raw)}`; } } } },
                            scales: { y: { ticks: { callback: v => fmt(v) } } }
                        }
                    });
                })();

                // ---- BUDGET PERFORMANCE (grouped bar) ----
                (function(){
                    const rows = data.budget_performance || [];
                    const labels = rows.map(r => r.label);
                    const budgets = rows.map(r => r.budget);
                    const spent = rows.map(r => r.spent);
                    const colors = rows.map(r => r.color || PRIMARY);

                    const ctx = document.getElementById('budgetChart');
                    if (!ctx) return;
                    showLoaded('#budgetChart');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [
                                { label: 'Budget', data: budgets, backgroundColor: colors.map(c=>PRIMARY), categoryPercentage:0.6 },
                                { label: 'Spent', data: spent, backgroundColor: colors.map(c=> 'rgba(255,165,0,0.9)'), categoryPercentage:0.6 }
                            ]
                        },
                        options: {
                            responsive:true,
                            plugins: {
                                tooltip: { callbacks: { label(ctx){ return `${ctx.dataset.label}: ${fmt(ctx.raw)}`; } } },
                                legend: { position:'bottom' }
                            },
                            scales: { y: { ticks: { callback: v => fmt(v) } } }
                        }
                    });
                })();

                // ---- DAILY SPENDING (area + cumulative) ----
                (function(){
                    const rows = data.daily_spending || [];
                    const labels = rows.map(r=> r.day);
                    const daily = rows.map(r=> r.amount);
                    const cumulative = rows.map(r=> r.cumulative);

                    const ctx = document.getElementById('dailyChart');
                    if (!ctx) return;
                    showLoaded('#dailyChart');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [
                                { label: 'Daily', data: daily, borderColor: DANGER, backgroundColor: 'rgba(239,68,68,0.12)', tension:0.25, fill:false },
                                { label: 'Cumulative', data: cumulative, borderColor: PRIMARY, backgroundColor: 'rgba(202,167,57,0.14)', tension:0.25, fill:true }
                            ]
                        },
                        options: {
                            responsive:true,
                            plugins: { tooltip: { callbacks: { label(ctx){ return `${ctx.dataset.label}: ${fmt(ctx.raw)}`; } } } },
                            scales: { y: { ticks: { callback: v => fmt(v) } } }
                        }
                    });
                })();

            } catch (err) {
                console.error('Charts load error', err);
                // hide loaders
                document.querySelectorAll('.loader').forEach(l=> l.textContent='Unable to load');
            }
        }

        window.addEventListener('DOMContentLoaded', loadDashboardCharts);
    </script>

</body>
</html>
