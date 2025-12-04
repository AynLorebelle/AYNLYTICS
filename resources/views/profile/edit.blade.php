<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - AYNLYTICS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    
    <style>
        .profile-header {
            background: linear-gradient(135deg, #154973, #4A70A9);
            padding: 2rem;
            border-radius: 12px 12px 0 0;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FFD166, #FFE100);
            border: 4px solid rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #052536;
            position: relative;
            overflow: hidden;
        }
        
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .avatar-upload {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 36px;
            height: 36px;
            background: #FFD166;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 3px solid #0c222b;
            transition: all 0.2s;
        }
        
        .avatar-upload:hover {
            background: #FFE100;
            transform: scale(1.1);
        }
        
        .avatar-upload input {
            display: none;
        }
        
        .nav-tabs {
            border-bottom: 2px solid rgba(255,255,255,0.1);
            gap: 1rem;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: rgba(255,255,255,0.6);
            padding: 1rem 1.5rem;
            background: transparent;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
        }
        
        .nav-tabs .nav-link:hover {
            color: rgba(255,255,255,0.9);
            border-bottom-color: rgba(255,209,102,0.3);
        }
        
        .nav-tabs .nav-link.active {
            color: #FFD166;
            background: transparent;
            border-bottom-color: #FFD166;
        }
        
        .form-section {
            padding: 2rem;
        }
        
        .stats-card {
            background: rgba(74, 112, 169, 0.1);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
        }
        
        .stats-card h3 {
            color: #FFD166;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .stats-card p {
            color: rgba(255,255,255,0.7);
            font-size: 0.875rem;
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg ayn-navbar">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #4A70A9, #87CEEB); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                    📊
                </div>
                <span>AYNLYTICS</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <span class="nav-link">{{ Auth::user()->name }}</span>
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
    <main class="container" style="max-width: 1200px; margin-top: 2rem;">
        <!-- Page Header -->
        <div class="mb-4">
            <h1 style="color: #ffffff; font-weight: bold; font-size: 2rem; margin-bottom: 0.5rem;">
                Profile Settings
            </h1>
            <p style="color: rgba(255,255,255,0.6); font-size: 0.875rem;">
                Manage your account settings and preferences
            </p>
        </div>

        <div class="row g-4">
            <!-- Main Profile Card -->
            <div class="col-lg-8">
                <div class="card">
                    <!-- Profile Header -->
                    <div class="profile-header">
                        <div class="d-flex align-items-center gap-4">
                            <div style="position: relative;">
                                <div class="profile-avatar" id="profileAvatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <label class="avatar-upload">
                                    <i class="bi bi-camera-fill" style="color: #052536;"></i>
                                    <input type="file" id="avatarUpload" accept="image/*">
                                </label>
                            </div>
                            <div>
                                <h2 style="color: #ffffff; font-weight: bold; margin-bottom: 0.5rem;">
                                    {{ Auth::user()->name ?? 'User Name' }}
                                </h2>
                                <p style="color: rgba(255,255,255,0.8); margin-bottom: 0.25rem;">
                                    <i class="bi bi-envelope me-2"></i>{{ Auth::user()->email ?? 'user@example.com' }}
                                </p>
                                <p style="color: rgba(255,255,255,0.7); margin: 0;">
                                    <i class="bi bi-calendar3 me-2"></i>Member since {{ Auth::user()->created_at->format('M Y') ?? 'Jan 2024' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs px-3 pt-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal" type="button">
                                <i class="bi bi-person me-2"></i>Personal Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#security" type="button">
                                <i class="bi bi-shield-lock me-2"></i>Security
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#preferences" type="button">
                                <i class="bi bi-gear me-2"></i>Preferences
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Personal Info Tab -->
                        <div class="tab-pane fade show active" id="personal">
                            <div class="form-section">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="+63 912 345 6789">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control" placeholder="Quezon City, Metro Manila">
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Bio</label>
                                            <textarea name="bio" class="form-control" rows="3" placeholder="Tell us about yourself..."></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button type="submit" class="btn ayn-cta">
                                            <i class="bi bi-check-circle me-2"></i>Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Security Tab -->
                        <div class="tab-pane fade" id="security">
                            <div class="form-section">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" name="current_password" class="form-control" required>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button type="submit" class="btn ayn-cta">
                                            <i class="bi bi-shield-check me-2"></i>Update Password
                                        </button>
                                    </div>
                                </form>

                                <hr style="border-color: rgba(255,255,255,0.1); margin: 2rem 0;">

                                <div>
                                    <h5 style="color: #FFD166; margin-bottom: 1rem;">Two-Factor Authentication</h5>
                                    <p style="color: rgba(255,255,255,0.7); font-size: 0.875rem; margin-bottom: 1rem;">
                                        Add an extra layer of security to your account
                                    </p>
                                    <button class="btn btn-outline-primary">
                                        <i class="bi bi-phone me-2"></i>Enable 2FA
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Preferences Tab -->
                        <div class="tab-pane fade" id="preferences">
                            <div class="form-section">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Currency</label>
                                            <select class="form-select">
                                                <option selected>Philippine Peso (₱)</option>
                                                <option>US Dollar ($)</option>
                                                <option>Euro (€)</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Date Format</label>
                                            <select class="form-select">
                                                <option selected>MM/DD/YYYY</option>
                                                <option>DD/MM/YYYY</option>
                                                <option>YYYY-MM-DD</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                                                <label class="form-check-label" for="emailNotif">
                                                    Email Notifications
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="budgetAlerts" checked>
                                                <label class="form-check-label" for="budgetAlerts">
                                                    Budget Alert Notifications
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button type="submit" class="btn ayn-cta">
                                            <i class="bi bi-check-circle me-2"></i>Save Preferences
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Stats -->
            <div class="col-lg-4">
                <div class="stats-card mb-3">
                    <i class="bi bi-cash-stack" style="font-size: 2rem; color: #FFD166;"></i>
                    <h3>₱{{ number_format($totalBudget, 2) }}</h3>
                    <p>Total Budget This Month</p>
                </div>
                
                <div class="stats-card mb-3">
                    <i class="bi bi-wallet2" style="font-size: 2rem; color: #ef4444;"></i>
                    <h3>₱{{ number_format($totalExpenses, 2) }}</h3>
                    <p>Total Spent</p>
                </div>
                
                <div class="stats-card mb-3">
                    <i class="bi bi-piggy-bank" style="font-size: 2rem; color: {{ $remaining >= 0 ? '#10b981' : '#ef4444' }};"></i>
                    <h3 style="color: {{ $remaining >= 0 ? '#10b981' : '#ef4444' }};">₱{{ number_format($remaining, 2) }}</h3>
                    <p>Remaining Balance</p>
                </div>
                
                <div class="stats-card mb-3">
                    <i class="bi bi-graph-up-arrow" style="font-size: 2rem; color: #10b981;"></i>
                    <h3>₱{{ number_format($totalIncome, 2) }}</h3>
                    <p>Total Income This Month</p>
                </div>

                <<div class="card dark-card">
    <div class="card-body">
        <h5 class="mb-3"><i class="bi bi-activity me-2"></i>Recent Activity</h5>
        <div class="d-flex flex-column gap-3">
            @forelse($recentExpenses as $expense)
            <div class="d-flex align-items-start gap-2">
                <i class="bi bi-circle-fill" style="color: #ef4444; font-size: 0.5rem; margin-top: 0.5rem;"></i>
                <div style="flex: 1;">
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 0.25rem; font-size: 0.875rem;">
                        <strong>{{ $expense->category }}</strong>: {{ $expense->description ?? 'Expense' }} - ₱{{ number_format($expense->amount, 2) }}
                    </p>
                    <p style="color: rgba(255,255,255,0.5); margin: 0; font-size: 0.75rem;">
                        {{ \Carbon\Carbon::parse($expense->transaction_date)->diffForHumans() }}
                    </p>
                </div>
            </div>
            @empty
            @endforelse
            
            @forelse($recentIncomes as $income)
            <div class="d-flex align-items-start gap-2">
                <i class="bi bi-circle-fill" style="color: #10b981; font-size: 0.5rem; margin-top: 0.5rem;"></i>
                <div style="flex: 1;">
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 0.25rem; font-size: 0.875rem;">
                        <strong>Income</strong>: {{ $income->source }} - ₱{{ number_format($income->amount, 2) }}
                    </p>
                    <p style="color: rgba(255,255,255,0.5); margin: 0; font-size: 0.75rem;">
                        {{ \Carbon\Carbon::parse($income->transaction_date)->diffForHumans() }}
                    </p>
                </div>
            </div>
            @empty
            @endforelse
            
            @if($recentExpenses->isEmpty() && $recentIncomes->isEmpty())
            <p style="color: rgba(255,255,255,0.5); font-size: 0.875rem; text-align: center;">
                No recent activity
            </p>
            @endif
        </div>
    </div>
</div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Avatar upload preview
        document.getElementById('avatarUpload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatar = document.getElementById('profileAvatar');
                    avatar.innerHTML = <img src="${e.target.result}" alt="Profile">;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>