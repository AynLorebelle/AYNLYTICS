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

        /* Navbar Styles */
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
            text-decoration: none;
            display: inline-block;
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

        .mark-read-btn {
            background: rgba(255,255,255,0.1);
            color: #ffffff;
            border: none;
            transition: all 0.2s;
        }

        .mark-read-btn:hover {
            background: rgba(255,255,255,0.15);
            color: #FFD166;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 0;
        }

        .empty-state i {
            font-size: 4rem;
            color: rgba(255,255,255,0.2);
        }

        .empty-state h4 {
            color: rgba(255,255,255,0.6);
            margin-top: 1rem;
        }

        .empty-state p {
            color: rgba(255,255,255,0.4);
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
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notifications') }}">
                            <i class="bi bi-bell"></i> Notifications
                            @if(isset($unreadCount) && $unreadCount > 0)
                                <span class="badge bg-danger rounded-pill ms-1">{{ $unreadCount }}</span>
                            @endif
                        </a>
                    </li>
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
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
            @if(isset($unreadCount) && $unreadCount > 0)
                <form method="POST" action="{{ route('notifications.markAllRead') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm mark-read-btn">
                        <i class="bi bi-check-all me-2"></i>Mark all as read
                    </button>
                </form>
            @endif
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <a href="{{ route('notifications') }}?filter=all" class="filter-tab {{ $filter === 'all' ? 'active' : '' }}">
                All
            </a>
            <a href="{{ route('notifications') }}?filter=income" class="filter-tab {{ $filter === 'income' ? 'active' : '' }}">
                Income
            </a>
            <a href="{{ route('notifications') }}?filter=expenses" class="filter-tab {{ $filter === 'expenses' ? 'active' : '' }}">
                Expenses
            </a>
        </div>

        <!-- Notifications List -->
        <div class="notifications-list">
            @if(isset($notifications) && $notifications->count())
                @foreach($notifications as $notification)
                    <div class="notification-item {{ $notification['is_unread'] ? 'unread' : '' }}">
                        <div class="d-flex gap-3">
                            <div class="notification-icon {{ $notification['icon'] }}">
                                <i class="bi {{ $notification['icon_class'] }}"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="notification-title">{{ $notification['title'] }}</div>
                                <div class="notification-message">
                                    {{ $notification['message'] }}
                                </div>
                                <div class="notification-time">
                                    <i class="bi bi-clock me-1"></i>{{ $notification['time'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="bi bi-bell-slash"></i>
                    <h4>No notifications yet</h4>
                    <p>We'll notify you when you add transactions</p>
                </div>
            @endif
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>