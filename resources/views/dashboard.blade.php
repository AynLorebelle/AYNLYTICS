
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
            background-color: rgba(10, 22, 40, 0.95);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        
        .header-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
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
        
        .nav-button {
            padding: 8px;
            color: white;
            background: transparent;
            border: none;
            cursor: pointer;
        }
        
        .menu-open {
        border-top: 1px solid #1f2937;
    background-color: #0a1628;
    padding: 16px 24px;
    display: flex;
    flex-direction: column;
    align-items: flex-center;  
        }
        
        .menu-nav {
            display: flex;
            flex-direction: column;
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
             width: auto;       /* <-- REMOVE full width */
    text-align: left;  /* can stay */
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
                    <div class="logo-icon"><img src="{{ asset('build/image/2.png') }}" alt=""></div>
                    <div class="logo-text">
                        <h1>AYNLYTICS</h1>
                        <p>Financial Planner</p>
                    </div>
                </div>
                
                <button class="nav-button" onclick="toggleMenu()">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
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
                    <h3 class="stat-value">&#8369;{{ number_format($totalIncomes ?? 0,2) }}</h3>
                    <span class="stat-change positive">+12.5%</span>
                </div>
            </div>
            <div class="stat-card">
                <p class="stat-label">Monthly Income</p>
                <div class="stat-row">
                    <h3 class="stat-value">&#8369;{{ number_format($totalIncomes ?? 0,2) }}</h3>
                    <span class="stat-change positive">+3.2%</span>
                </div>
            </div>
            <div class="stat-card">
                <p class="stat-label">Expenses</p>
                <div class="stat-row">
                    <h3 class="stat-value">&#8369;{{ number_format($totalExpenses ?? 0,2) }}</h3>
                    <span class="stat-change positive">-5.1%</span>
                </div>
            </div>
            <div class="stat-card">
                <p class="stat-label">Savings Goal</p>
                <div class="stat-row">
                    <h3 class="stat-value">68%</h3>
                    <span class="stat-change positive">+8%</span>
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
                    <div class="transaction-item">
                        <div>
                            <p class="transaction-name">Salary Deposit</p>
                            <p class="transaction-date">Nov 25</p>
                        </div>
                        <p class="transaction-amount income">$8,500</p>
                    </div>
                    <div class="transaction-item">
                        <div>
                            <p class="transaction-name">Rent Payment</p>
                            <p class="transaction-date">Nov 24</p>
                        </div>
                        <p class="transaction-amount expense">-$1,500</p>
                    </div>
                    <div class="transaction-item">
                        <div>
                            <p class="transaction-name">Groceries</p>
                            <p class="transaction-date">Nov 23</p>
                        </div>
                        <p class="transaction-amount expense">-$234</p>
                    </div>
                    <div class="transaction-item">
                        <div>
                            <p class="transaction-name">Freelance Work</p>
                            <p class="transaction-date">Nov 22</p>
                        </div>
                        <p class="transaction-amount income">$1,200</p>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div class="quick-actions-grid">
                    <button class="action-button" style="border-color: #10b981;" onmouseover="this.style.backgroundColor='#10b981'" onmouseout="this.style.backgroundColor='#0a1628'">
                        <svg class="icon" fill="none" stroke="#10b981" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Add Income</span>
                    </button>
                    <button class="action-button" style="border-color: #ef4444;" onmouseover="this.style.backgroundColor='#ef4444'" onmouseout="this.style.backgroundColor='#0a1628'">
                        <svg class="icon" fill="none" stroke="#ef4444" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Add Expense</span>
                    </button>
                    <button class="action-button" style="border-color: #3b82f6;" onmouseover="this.style.backgroundColor='#3b82f6'" onmouseout="this.style.backgroundColor='#0a1628'">
                        <svg class="icon" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span>View Analytics</span>
                    </button>
                    <button class="action-button" style="border-color: #d4a574;" onmouseover="this.style.backgroundColor='#d4a574'" onmouseout="this.style.backgroundColor='#0a1628'">
                        <svg class="icon" fill="none" stroke="#d4a574" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Set Goal</span>
                    </button>
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

</body>
</html>
