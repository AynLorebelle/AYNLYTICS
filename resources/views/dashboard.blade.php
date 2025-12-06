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
            padding: 5px;
            color: #ffffffff;
            background: transparent;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 25px;
            
            
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
            box-shadow: 
                0 5px 25px rgba(77, 152, 244, 0.6),
                0 0 0 0px rgba(251, 252, 255, 0.2);
            background: transparent;
        }
        
        .menu-item.active {
            background-color: tranparent;
            border: 2px solid #FFD166;
            boreder-radius: 8px;
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
            margin-left: -10px;
        }
        
        .welcome-section p {
            color: #9ca3af;
             margin-left: -10px;

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
                  <a href="{{ route('profile.edit') }}" class="header-icon {{ request()->routeIs('profile.edit') ? 'active' : '' }}>
                <button class="header-icon " onclick="toggleProfile()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                </path> 
            </svg>
          
        </button>
   </a>

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

    <!-- Analytics -->
    <a class="nav-link menu-item" 
       href="{{ route('analytics.index') }}" 
       onclick="setActive(1)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
        </svg>
        <span>Analytics</span>
    </a>

    <!-- Budget -->
    <a class="nav-link menu-item" 
       href="{{ route('budgets.index') }}" 
       onclick="setActive(2)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>Budget</span>
    </a>

    <!-- Expenses -->
    <a class="nav-link menu-item" 
       href="{{ route('expenses.index') }}" 
       onclick="setActive(3)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l6 6 4-4 8 8"/>
        </svg>
        <span>Expenses</span>
    </a>

    <!-- Categories -->
    <a class="nav-link menu-item" 
       href="{{ route('categories.index') }}" 
       onclick="setActive(4)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M3 11l8.586 8.586a2 2 0 002.828 0L21 13l-8-8H5a2 2 0 00-2 2v4z"/>
        </svg>
        <span>Categories</span>
    </a>

    <!-- Income -->
    <a class="nav-link menu-item" 
       href="{{ route('incomes.index') }}" 
       onclick="setActive(5)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>Income</span>
    </a>
    
            </nav>
        </div>
    </header>
<!-- Main Content -->
<main class="main-content">
    <div class="welcome-section">
        <h2>Welcome back !</h2>
        <p>Here's what's happening with your finances today.</p>
    </div>

    <div class="stats-grid">
        <!-- UPDATED: Remaining Budget Card -->
        <div class="stat-card">
            <p class="stat-label">Remaining Budget</p>
            <div class="stat-row">
                <h3 class="stat-value" style="color: {{ $remainingBudget < 0 ? '#ef4444' : ($remainingBudget < $totalBudgets * 0.2 ? '#fbbf24' : '#ffffff') }}">
                    &#8369;{{ number_format($remainingBudget ?? 0, 2) }}
                </h3>
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
                        <div style="background-color: {{ $totalExpenses > $totalBudgets ? '#ef4444' : '#10b981' }}; height: 100%; width: {{ min(($totalExpenses / $totalBudgets) * 100, 100) }}%; transition: width 0.3s ease;"></div>
                    </div>
                    <p style="font-size: 11px; color: #6b7280; margin-top: 4px; text-align: center;">
                        {{ round(min(($totalExpenses / $totalBudgets) * 100, 100), 1) }}% used
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Monthly Income Card -->
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

        <!-- Expenses Card -->
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

        <!-- Savings Goal Card -->
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

    <!-- Recent Transactions -->
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


        
    </script>

</body>
</html>
