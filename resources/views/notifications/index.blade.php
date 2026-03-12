@extends('layouts.app')

@section('title', 'Notifications - Aynlytics')

@push('styles')
<style>
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
        border-color: rgba(6,182,212,0.2);
        transform: translateX(4px);
    }
    .notification-item.unread {
        border-left: 4px solid #06b6d4;
        background: rgba(6, 182, 212, 0.05);
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
    .notification-icon.success { background: rgba(16,185,129,0.1); color: #10b981; }
    .notification-icon.warning { background: rgba(239,68,68,0.1); color: #ef4444; }
    .notification-icon.info    { background: rgba(6,182,212,0.1); color: #06b6d4; }
    .notification-title   { color: #ffffff; font-weight: 600; margin-bottom: 0.25rem; }
    .notification-message { color: rgba(255,255,255,0.7); font-size: 0.875rem; margin-bottom: 0.5rem; }
    .notification-time    { color: rgba(255,255,255,0.5); font-size: 0.75rem; }
    .filter-tabs {
        background: rgba(15,41,56,0.5);
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
    .filter-tab:hover { color: rgba(255,255,255,0.9); background: rgba(255,255,255,0.05); }
    .filter-tab.active { background: linear-gradient(135deg, #06b6d4, #0891b2); color: #ffffff; font-weight: 600; }
    .mark-read-btn { background: rgba(255,255,255,0.1); color: #ffffff; border: none; transition: all 0.2s; }
    .mark-read-btn:hover { background: rgba(255,255,255,0.15); color: #06b6d4; }
    .empty-state { text-align: center; padding: 3rem 0; }
    .empty-state i { font-size: 4rem; color: rgba(255,255,255,0.2); }
    .empty-state h4 { color: rgba(255,255,255,0.6); margin-top: 1rem; }
    .empty-state p  { color: rgba(255,255,255,0.4); }
</style>
@endpush

@section('content')
<main class="container" style="max-width: 900px; margin-top: 2rem;">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"
             style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #10b981;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 style="color:#ffffff; font-weight:bold; font-size:2rem; margin-bottom:0.5rem;">
                <i class="bi bi-bell me-2"></i>Notifications
            </h1>
            <p style="color:rgba(255,255,255,0.6); font-size:0.875rem; margin:0;">
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

    <div class="filter-tabs">
        <a href="{{ route('notifications') }}?filter=all"      class="filter-tab {{ $filter === 'all'      ? 'active' : '' }}">All</a>
        <a href="{{ route('notifications') }}?filter=income"   class="filter-tab {{ $filter === 'income'   ? 'active' : '' }}">Income</a>
        <a href="{{ route('notifications') }}?filter=expenses" class="filter-tab {{ $filter === 'expenses' ? 'active' : '' }}">Expenses</a>
        <a href="{{ route('notifications') }}?filter=budget"   class="filter-tab {{ $filter === 'budget'   ? 'active' : '' }}">Budget</a>
        <a href="{{ route('notifications') }}?filter=category" class="filter-tab {{ $filter === 'category' ? 'active' : '' }}">Category</a>
    </div>

    <div class="notifications-list">
        @if(isset($notifications) && $notifications->count())
            @foreach($notifications as $notification)
                <div class="notification-item {{ $notification['is_unread'] ? 'unread' : '' }}">
                    <div class="d-flex gap-3">
                        <div class="notification-icon {{ $notification['icon'] }}">
                            <i class="bi {{ $notification['icon_class'] }}"></i>
                        </div>
                        <div style="flex:1;">
                            <div class="notification-title">{{ $notification['title'] }}</div>
                            <div class="notification-message">{{ $notification['message'] }}</div>
                            <div class="notification-time">
                                <i class="bi bi-clock me-1"></i>{{ $notification['time'] }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="bi bi-bell-slash"></i>
                <h4>No notifications yet</h4>
                <p>We'll notify you when you add transactions</p>
            </div>
        @endif
    </div>
</main>
@endsection