@extends('layouts.app')

@section('title', 'Profile Settings - Aynlytics')

@push('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #154973, #4A70A9);
        padding: 2rem;
        border-radius: 12px 12px 0 0;
    }
    .profile-avatar {
        width: 120px; height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        border: 4px solid rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 3rem; color: #ffffff;
        position: relative; overflow: hidden;
    }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .avatar-upload {
        position: absolute; bottom: 0; right: 0;
        width: 36px; height: 36px;
        background: #06b6d4; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; border: 3px solid #0a1628; transition: all 0.2s;
    }
    .avatar-upload:hover { background: #0891b2; transform: scale(1.1); }
    .avatar-upload input { display: none; }
    .nav-tabs { border-bottom: 2px solid rgba(255,255,255,0.1); gap: 1rem; }
    .nav-tabs .nav-link {
        border: none; color: rgba(255,255,255,0.6);
        padding: 1rem 1.5rem; background: transparent;
        border-bottom: 3px solid transparent; transition: all 0.2s;
    }
    .nav-tabs .nav-link:hover { color: rgba(255,255,255,0.9); border-bottom-color: rgba(6,182,212,0.3); }
    .nav-tabs .nav-link.active { color: #06b6d4; background: transparent; border-bottom-color: #06b6d4; }
    .form-section { padding: 2rem; }
    .stats-card {
        background: rgba(6,182,212,0.05);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 8px; padding: 1.5rem; text-align: center;
    }
    .stats-card h3 { color: #06b6d4; font-size: 2rem; font-weight: bold; margin-bottom: 0.5rem; }
    .stats-card p  { color: rgba(255,255,255,0.7); font-size: 0.875rem; margin: 0; }
    .form-label { color: rgba(255,255,255,0.9); font-weight: 500; margin-bottom: 0.5rem; }
    .form-control, .form-select {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1); color: #ffffff;
    }
    .form-control:focus, .form-select:focus {
        background: rgba(255,255,255,0.08);
        border-color: #06b6d4; color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(6,182,212,0.1);
    }
    .form-check-input { background-color: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); }
    .form-check-input:checked { background-color: #06b6d4; border-color: #06b6d4; }
    .form-check-label { color: rgba(255,255,255,0.9); }
    .ayn-cta {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: #ffffff; border: none; padding: 0.5rem 1.5rem;
        font-weight: 600; border-radius: 6px; transition: all 0.2s;
    }
    .ayn-cta:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(6,182,212,0.3); color: #ffffff; }
</style>
@endpush

@section('content')
<main class="container" style="max-width: 1200px; margin-top: 2rem;">
    <div class="mb-4">
        <h1 style="color:#ffffff; font-weight:bold; font-size:2rem; margin-bottom:0.5rem;">Profile Settings</h1>
        <p style="color:rgba(255,255,255,0.6); font-size:0.875rem;">Manage your account settings and preferences</p>
    </div>

    <div class="row g-4">
        <!-- Main Profile Card -->
        <div class="col-lg-8">
            <div class="ui-card">
                <div class="profile-header">
                    <div class="d-flex align-items-center gap-4">
                        <div style="position:relative;">
                            <div class="profile-avatar" id="profileAvatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <label class="avatar-upload">
                                <i class="bi bi-camera-fill" style="color:#ffffff;"></i>
                                <input type="file" id="avatarUpload" accept="image/*">
                            </label>
                        </div>
                        <div>
                            <h2 style="color:#ffffff; font-weight:bold; margin-bottom:0.5rem;">{{ Auth::user()->name }}</h2>
                            <p style="color:rgba(255,255,255,0.8); margin-bottom:0.25rem;">
                                <i class="bi bi-envelope me-2"></i>{{ Auth::user()->email }}
                            </p>
                            <p style="color:rgba(255,255,255,0.7); margin:0;">
                                <i class="bi bi-calendar3 me-2"></i>Member since {{ Auth::user()->created_at->format('M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs px-3 pt-3" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal" type="button">
                            <i class="bi bi-person me-2"></i>Personal Info
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#security" type="button">
                            <i class="bi bi-shield-lock me-2"></i>Security
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#preferences" type="button">
                            <i class="bi bi-gear me-2"></i>Preferences
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="personal">
                        <div class="form-section">
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf @method('PATCH')
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" name="phone" class="form-control" placeholder="+63 912 345 6789">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control" placeholder="Cebu City">
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

                    <div class="tab-pane fade" id="security">
                        <div class="form-section">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf @method('PUT')
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
                        </div>
                    </div>

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
                                            <label class="form-check-label" for="emailNotif">Email Notifications</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="budgetAlerts" checked>
                                            <label class="form-check-label" for="budgetAlerts">Budget Alert Notifications</label>
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
                <i class="bi bi-cash-stack" style="font-size:2rem; color:#06b6d4;"></i>
                <h3>₱{{ number_format($totalBudget ?? 0, 2) }}</h3>
                <p>Total Budget This Month</p>
            </div>
            <div class="stats-card mb-3">
                <i class="bi bi-wallet2" style="font-size:2rem; color:#ef4444;"></i>
                <h3 style="color:#ef4444;">₱{{ number_format($totalExpenses ?? 0, 2) }}</h3>
                <p>Total Spent</p>
            </div>
            <div class="stats-card mb-3">
                <i class="bi bi-piggy-bank" style="font-size:2rem; color:{{ ($remaining ?? 0) >= 0 ? '#10b981' : '#ef4444' }};"></i>
                <h3 style="color:{{ ($remaining ?? 0) >= 0 ? '#10b981' : '#ef4444' }};">₱{{ number_format($remaining ?? 0, 2) }}</h3>
                <p>Remaining Balance</p>
            </div>
            <div class="stats-card mb-3">
                <i class="bi bi-graph-up-arrow" style="font-size:2rem; color:#10b981;"></i>
                <h3 style="color:#10b981;">₱{{ number_format($totalIncome ?? 0, 2) }}</h3>
                <p>Total Income This Month</p>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.getElementById('avatarUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const avatar = document.getElementById('profileAvatar');
                avatar.innerHTML = `<img src="${e.target.result}" alt="Profile">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush