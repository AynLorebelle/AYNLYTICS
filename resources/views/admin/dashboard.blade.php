<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AYNLYTICS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
<style>
    body {
        padding-top: 70px;
        background: #0a1628;
        font-family: Inter, Arial, sans-serif;
    }

    /* Navbar */
    .ayn-navbar {
        background: #0a1e36;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 0px;
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

    .admin-badge {
        background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-left: 10px;
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

    /* Stats Cards */
    .stat-card {
        background: rgba(15, 41, 56, 0.5);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s;
    }

    .stat-card:hover {
        border-color: rgba(255,209,102,0.2);
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .stat-icon.users {
        background: rgba(74, 144, 226, 0.1);
        color: #4A90E2;
    }

    .stat-icon.income {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .stat-icon.expense {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .stat-icon.budget {
        background: rgba(255, 209, 102, 0.1);
        color: #FFD166;
    }

    .stat-title {
        color: rgba(255,255,255,0.6);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0;
    }

    /* Tables Container */
    .data-table {
        background: rgba(15, 41, 56, 0.5);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .table-title {
        color: #FFD166;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    /* ✅ DARK CUSTOM TABLE DESIGN (REPLACES WHITE BOOTSTRAP LOOK) */
/* ✅ CUSTOM DARK TABLE — NO BOOTSTRAP */
.ayn-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: rgba(10, 22, 40, 0.7);
    border-radius: 12px;
    overflow: hidden;
    color: #ffffff;
}

/* Header */
.ayn-table thead {
    background: linear-gradient(135deg, #0f2a44, #122e4a);
}

.ayn-table thead th {
    color: #FFD166;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.6px;
    padding: 14px 16px;
    border-bottom: 1px solid rgba(255, 209, 102, 0.25);
    text-align: left;
}

/* Body rows */
.ayn-table tbody tr {
    background: rgba(10, 22, 40, 0.6);
    transition: all 0.2s ease;
}

.ayn-table tbody tr:hover {
    background: rgba(255, 209, 102, 0.08);
    transform: scale(1.002);
}

/* Table cells */
.ayn-table tbody td {
    padding: 14px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.9);
}

.ayn-table tbody tr:last-child td {
    border-bottom: none;
}

/* Role badges stay visible on dark */
.user-badge.admin {
    background: rgba(255, 107, 107, 0.25);
    color: #FF6B6B;
}

.user-badge.user {
    background: rgba(74, 144, 226, 0.25);
    color: #4A90E2;
}


    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {ayn-table
        color: #ffffff;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: rgba(255,255,255,0.6);
        font-size: 0.875rem;
    }
</style>

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg ayn-navbar">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
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
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-house"></i> Admin Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people"></i> Manage Users
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <span class="nav-link">{{ auth()->user()->name }}</span>
                    </li>
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
    <main class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header mt-4">
            <h1 class="page-title">
                <i class="bi bi-speedometer2 me-2" style="color: #FFD166;"></i><span style="color: #FFD166;">Admin Dashboard</span>
            </h1>
            <p class="page-subtitle">Monitor and manage your AYNLYTICS platform</p>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon users">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <p class="stat-title">Total Users</p>
                    <h2 class="stat-value">{{ $totalUsers }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon users">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <p class="stat-title">Admins</p>
                    <h2 class="stat-value">{{ $totalAdmins }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon income">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <p class="stat-title">Total Income</p>
                    <h2 class="stat-value">₱{{ number_format($totalIncomes, 2) }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon expense">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <p class="stat-title">Total Expenses</p>
                    <h2 class="stat-value">₱{{ number_format($totalExpenses, 2) }}</h2>
                </div>
            </div>
        </div>

        <!-- Recent Users Table -->
        <div class="data-table ">
            <h3 class="table-title">
                <i class="bi bi-clock-history me-2"></i>Recent Users
            </h3>
            <div class="table-responsive">
                <table class="ayn-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="user-badge {{ $user->role }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm" style="background: rgba(74, 144, 226, 0.2); color: #4A90E2; border: none;">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Most Active Users -->
        <div class="data-table">
            <h3 class="table-title">
                <i class="bi bi-graph-up-arrow me-2"></i>Most Active Users
            </h3>
            <div class="table-responsive">
                <table class="ayn-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Incomes</th>
                            <th>Expenses</th>
                            <th>Total Transactions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->incomes_count }}</td>
                            <td>{{ $user->expenses_count }}</td>
                            <td><strong>{{ $user->incomes_count + $user->expenses_count }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>