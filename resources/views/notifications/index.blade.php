<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - AYNLYTICS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    
    <style>
        body {
            padding-top: 70px;
            background: #0a1628;
        }

        /* Navbar Styles (same as your profile page) */
        .ayn-navbar {
            background: #0a1e36;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 10px;
        }

        .brand-logo-container {
            width: 70px;
            height: 70px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
        }

        .brand-logo {
            width: 130px;
            height: 130px;
            margin-top: 15px;
            margin-left: 80px;
            margin-right: -20px;
            object-fit: contain;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #FFD166 !important;
            font-weight: 600;
            font-size: 1.25rem;
            text-decoration: none;
        }

        .ayn-navbar .nav-link {
            color: rgba(255,255,255,0.8);
            transition: color 0.2s;
            margin-right: 50px;
        }

        .ayn-navbar .nav-link:hover {
            color: #FFD166;
        }

        .ayn-cta {
            background: linear-gradient(135deg, #FFD166, #FFE100);
            color: #052536;
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.2s;
            margin-right: 30px;
            margin-top: 5px;
        }

        .ayn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 209, 102, 0.3);
            color: #052536;
        }

        /* Notifications Styles */
        .notification-item {
            background: rgba(15, 41, 56, 0.5);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 8px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }

        .notification-item:hover {
            background: rgba(15, 41, 56, 0.7);
            border-color: rgba(255,209,102,0.2);
            transform: translateX(4px);
        }

        .notification-item.unread {
            border-left: 4px solid #FFD166;
            background: rgba(255, 209, 102, 0.05);
        }

        .notification-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .notification-icon.success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .notification-icon.warning {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .notification-icon.info {
            background: rgba(255, 209, 102, 0.1);
            color: #FFD166;
        }

        .notification-title {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .notification-message {
            color: rgba(255,255,255,0.7);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .notification-time {
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
        }

        .filter-tabs {
            background: rgba(15, 41, 56, 0.5);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 8px;
            padding: 0.5rem;
            display: inline-flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .filter-tab {
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.6);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .filter-tab:hover {
            color: rgba(255,255,255,0.9);
            background: rgba(255,255,255,0.05);
        }

        .filter-tab.active {
            background: linear-gradient(135deg, #FFD166, #FFE100);
            color: #052536;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg ayn-navbar">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <div class="brand-logo-container">
                    <img src="{{ asset('build/image/2.svg') }}" alt="AYNLYTICS Logo" class="brand-logo">
                </div>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    
                    @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn ayn-cta">Log Out</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container" style="max-width: 900px; margin-top: 2rem;">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 style="color: #ffffff; font-weight: bold; font-size: 2rem; margin-bottom: 0.5rem;">
                    <i class="bi bi-bell me-2"></i>Notifications
                </h1>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.875rem; margin: 0;">
                    Stay updated with your financial activities
                </p>
            </div>
            <button class="btn btn-sm" style="background: rgba(255,255,255,0.1); color: #ffffff; border: none;">
                <i class="bi bi-check-all me-2"></i>Mark all as read
            </button>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active">All</button>
            <button class="filter-tab">Budget Alerts</button>
            <button class="filter-tab">Income</button>
            <button class="filter-tab">Expenses</button>
        </div>

        <!-- Notifications List -->
        <div class="notifications-list">
            <!-- Unread Notification -->
            <div class="notification-item unread">
                <div class="d-flex gap-3">
                    <div class="notification-icon warning">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="notification-title">Budget Alert: Food & Dining</div>
                        <div class="notification-message">
                            You've spent ₱8,500 out of ₱10,000 budget (85%). Consider reducing expenses.
                        </div>
                        <div class="notification-time">
                            <i class="bi bi-clock me-1"></i>5 minutes ago
                        </div>
                    </div>
                </div>
            </div>

            <!-- Read Notification -->
            <div class="notification-item">
                <div class="d-flex gap-3">
                    <div class="notification-icon success">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="notification-title">Income Received</div>
                        <div class="notification-message">
                            Monthly salary of ₱45,000 has been added to your account.
                        </div>
                        <div class="notification-time">
                            <i class="bi bi-clock me-1"></i>2 hours ago
                        </div>
                    </div>
                </div>
            </div>

            <div class="notification-item">
                <div class="d-flex gap-3">
                    <div class="notification-icon info">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="notification-title">Monthly Report Ready</div>
                        <div class="notification-message">
                            Your November financial report is now available for review.
                        </div>
                        <div class="notification-time">
                            <i class="bi bi-clock me-1"></i>1 day ago
                        </div>
                    </div>
                </div>
            </div>

            <div class="notification-item">
                <div class="d-flex gap-3">
                    <div class="notification-icon warning">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="notification-title">Large Expense Detected</div>
                        <div class="notification-message">
                            An expense of ₱12,500 was recorded in Shopping category.
                        </div>
                        <div class="notification-time">
                            <i class="bi bi-clock me-1"></i>2 days ago
                        </div>
                    </div>
                </div>
            </div>

            <div class="notification-item">
                <div class="d-flex gap-3">
                    <div class="notification-icon success">
                        <i class="bi bi-piggy-bank"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="notification-title">Savings Goal Achieved</div>
                        <div class="notification-message">
                            Congratulations! You've reached your monthly savings goal of ₱15,000.
                        </div>
                        <div class="notification-time">
                            <i class="bi bi-clock me-1"></i>3 days ago
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (show when no notifications) -->
        <!-- <div class="text-center py-5">
            <i class="bi bi-bell-slash" style="font-size: 4rem; color: rgba(255,255,255,0.2);"></i>
            <h4 style="color: rgba(255,255,255,0.6); margin-top: 1rem;">No notifications yet</h4>
            <p style="color: rgba(255,255,255,0.4);">We'll notify you when something important happens</p>
        </div> -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>