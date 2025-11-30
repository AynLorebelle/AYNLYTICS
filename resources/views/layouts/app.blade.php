<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','AYNLYTICS')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
      /* ======== GLOBAL DARK THEME ======== */
      body {
          background: #0b1321;
          color: #e0e6ed;
      }
      a, .nav-link {
          color: #c8d7e6 !important;
      }
      a:hover, .nav-link:hover {
          color: #ffffff !important;
      }
      
      /* ======== NAVBAR ======== */
      .navbar-dark {
          background: #0d1b2a !important;
          border-bottom: 1px solid #1b263b;
      }
      .navbar-dark .navbar-brand {
          color: #3a86ff !important;
          font-weight: 600;
          letter-spacing: 1px;
      }
      .navbar-dark .dropdown-menu {
          background: #1b263b;
          border: 1px solid #415a77;
      }
      .navbar-dark .dropdown-item {
          color: #e0e6ed;
      }
      .navbar-dark .dropdown-item:hover {
          background: #415a77;
          color: white;
      }

      /* ======== CARDS ======== */
      .card {
          background: #0d1b2a !important;
          border: 1px solid #1b263b !important;
          border-radius: 12px;
          color: #e0e6ed;
      }

      /* ======== FORM INPUTS ======== */
      .form-control, .form-select, textarea {
          background: #1b263b !important;
          border: 1px solid #415a77 !important;
          color: #e0e6ed !important;
      }
      .form-control:focus, .form-select:focus, textarea:focus {
          border-color: #3a86ff !important;
          box-shadow: none !important;
          color: #fff !important;
      }
      label {
          color: #e0e6ed !important;
      }

      /* ======== TABLES ======== */
      table {
          color: #e0e6ed !important;
      }
      thead {
          background: #1b263b !important;
      }
      tbody tr {
          border-bottom: 1px solid #1b263b !important;
      }

      /* Ensure Bootstrap dark tables match the app's dark blue background
         - Make row backgrounds transparent so they inherit the card/body color
         - Keep a very subtle stripe if desired (disabled here so rows match exactly)
      */
      table.table.table-dark tbody tr,
      table.table.table-striped.table-dark tbody tr,
      table.table-dark tbody tr:nth-child(odd),
      table.table-striped.table-dark tbody tr:nth-child(odd) {
          background-color: transparent !important;
      }

      /* ======== BUTTONS ======== */
      .btn-primary {
          background: #3a86ff !important;
          border: none !important;
      }
      .btn-primary:hover {
          background: #1f6feb !important;
      }

      .btn-outline-primary {
          border-color: #3a86ff !important;
          color: #3a86ff !important;
      }
      .btn-outline-primary:hover {
          background: #3a86ff !important;
          color: #fff !important;
      }

      .btn-outline-danger {
          border-color: #ff4d6d !important;
          color: #ff4d6d !important;
      }
      .btn-outline-danger:hover {
          background: #ff4d6d !important;
          color: white !important;
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

  @stack('styles')
</head>

<body>
 <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-content">
                <div class="logo-section">
                    <div class="logo-icon"><img src="{{ asset('build/image/2.svg') }}" alt=""></div>
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

<main class="container py-4">
  @include('partials.alerts')
  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    function toggleMenu() {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    }
</script>
@stack('scripts')
<script>
    // Prevent double-submits: disable the submit button and change text when a form is submitted
    document.addEventListener('submit', function (e) {
        try {
            const form = e.target;
            const submit = form.querySelector('button[type=submit], input[type=submit]');
            if (submit) {
                submit.disabled = true;
                if (submit.tagName.toLowerCase() === 'button') {
                    submit.dataset.__orig = submit.innerHTML;
                    submit.innerHTML = 'Processing...';
                }
            }
        } catch (err) {
            console.error(err);
        }
    });
</script>
</body>

</html>
