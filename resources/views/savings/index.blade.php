@extends('layouts.app')

@section('title', 'Savings Goals - Aynlytics')

@push('styles')
<style>
    .savings-wrapper { max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem; }

    .goal-card {
        background: #0f1724;
        border: 1px solid #1f2937;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .goal-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.4);
    }
    .goal-card.completed { border-color: #10b981; }

    .progress-bar-track {
        background: #1f2937;
        border-radius: 999px;
        height: 10px;
        overflow: hidden;
        margin: 0.75rem 0;
    }
    .progress-bar-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #06b6d4, #0891b2);
        transition: width 0.6s ease;
    }
    .progress-bar-fill.completed { background: linear-gradient(90deg, #10b981, #059669); }

    .stat-pill {
        background: #1f2937;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        color: #9ca3af;
        display: inline-flex;
        flex-direction: column;
        gap: 2px;
    }
    .stat-pill span { color: #ffffff; font-weight: 600; font-size: 0.95rem; }

    .btn-teal {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: white; border: none; border-radius: 8px;
        padding: 0.5rem 1.2rem; font-weight: 600;
        cursor: pointer; transition: all 0.2s; font-size: 0.875rem;
    }
    .btn-teal:hover { opacity: 0.9; transform: translateY(-1px); color: white; }

    .btn-outline-teal {
        background: transparent;
        border: 1px solid #06b6d4;
        color: #06b6d4; border-radius: 8px;
        padding: 0.5rem 1.2rem; font-weight: 600;
        cursor: pointer; transition: all 0.2s; font-size: 0.875rem;
    }
    .btn-outline-teal:hover { background: #06b6d4; color: white; }

    .modal-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.7); z-index: 9998;
        align-items: center; justify-content: center;
    }
    .modal-overlay.show { display: flex; }

    .modal-box {
        background: #0f1724; border: 1px solid #1f2937;
        border-radius: 16px; padding: 2rem;
        width: 90%; max-width: 480px;
        max-height: 90vh; overflow-y: auto;
    }
    .modal-box h4 { color: #ffffff; font-weight: 700; margin-bottom: 1.5rem; }

    .form-label { color: rgba(255,255,255,0.8); font-size: 0.875rem; margin-bottom: 0.4rem; display: block; }
    .form-control {
        width: 100%; background: #1f2937;
        border: 1px solid #374151; border-radius: 8px;
        padding: 0.6rem 0.9rem; color: white;
        font-size: 0.875rem; margin-bottom: 1rem;
    }
    .form-control:focus { outline: none; border-color: #06b6d4; }

    .ai-advice-box {
        background: #111827; border: 1px solid #06b6d4;
        border-radius: 10px; padding: 1rem 1.25rem;
        color: #e5e7eb; font-size: 0.875rem;
        line-height: 1.6; white-space: pre-wrap;
        margin-top: 1rem; display: none;
    }

    .contributions-list { margin-top: 1rem; }
    .contribution-item {
        display: flex; justify-content: space-between;
        align-items: center; padding: 0.5rem 0;
        border-bottom: 1px solid #1f2937; font-size: 0.85rem;
    }
    .contribution-item:last-child { border-bottom: none; }

    .badge-status {
        font-size: 0.7rem; font-weight: 700;
        padding: 3px 10px; border-radius: 999px;
        text-transform: uppercase; letter-spacing: 0.05em;
    }
    .badge-active   { background: rgba(6,182,212,0.15); color: #06b6d4; }
    .badge-completed { background: rgba(16,185,129,0.15); color: #10b981; }

    .empty-state {
        text-align: center; padding: 4rem 2rem;
        color: rgba(255,255,255,0.4);
    }
    .empty-state i { font-size: 3.5rem; margin-bottom: 1rem; display: block; }
</style>
@endpush

@section('content')
<div class="savings-wrapper">

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success mb-4" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); color:#10b981; border-radius:8px; padding:0.75rem 1rem;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 style="color:#ffffff; font-weight:700; font-size:1.75rem; margin:0;">Savings Goals</h1>
            <p style="color:rgba(255,255,255,0.5); margin:0; font-size:0.875rem;">Track and grow your savings</p>
        </div>
        <button class="btn-teal" onclick="openModal('createModal')">
            <i class="bi bi-plus-lg me-1"></i> New Goal
        </button>
    </div>

    {{-- Goals --}}
    @if($goals->isEmpty())
        <div class="empty-state">
            <i class="bi bi-piggy-bank"></i>
            <h4 style="color:rgba(255,255,255,0.5);">No savings goals yet</h4>
            <p>Create your first goal to start tracking your savings!</p>
            <button class="btn-teal mt-2" onclick="openModal('createModal')">Create a Goal</button>
        </div>
    @else
        @foreach($goals as $goal)
        <div class="goal-card {{ $goal['status'] === 'completed' ? 'completed' : '' }}">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h5 style="color:#ffffff; font-weight:700; margin:0;">{{ $goal['name'] }}</h5>
                    <span class="badge-status {{ $goal['status'] === 'completed' ? 'badge-completed' : 'badge-active' }}">
                        {{ ucfirst($goal['status']) }}
                    </span>
                </div>
                <div class="d-flex gap-2">
                    @if($goal['status'] !== 'completed')
                    <button class="btn-outline-teal" onclick="openContribute({{ $goal['id'] }}, '{{ addslashes($goal['name']) }}')">
                        <i class="bi bi-plus-circle me-1"></i>Add
                    </button>
                    @endif
                    <button class="btn-outline-teal" onclick="getAIAdvice({{ $goal['id'] }}, '{{ addslashes($goal['name']) }}')">
                        <i class="bi bi-stars me-1"></i>AI
                    </button>
                    <form method="POST" action="{{ route('savings.destroy', $goal['id']) }}" onsubmit="return confirm('Remove this goal?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:transparent; border:1px solid #ef4444; color:#ef4444; border-radius:8px; padding:0.5rem 0.75rem; cursor:pointer;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Progress --}}
            <div class="d-flex justify-content-between" style="font-size:0.8rem; color:#9ca3af;">
                <span>₱{{ number_format($goal['total_saved'], 2) }} saved</span>
                <span>{{ $goal['progress_percent'] }}% of ₱{{ number_format($goal['target_amount'], 2) }}</span>
            </div>
            <div class="progress-bar-track">
                <div class="progress-bar-fill {{ $goal['status'] === 'completed' ? 'completed' : '' }}"
                     style="width: {{ $goal['progress_percent'] }}%"></div>
            </div>

            {{-- Stats row --}}
            <div class="d-flex flex-wrap gap-2 mt-2">
                <div class="stat-pill">
                    Remaining <span>₱{{ number_format($goal['remaining'], 2) }}</span>
                </div>
                @if($goal['target_date'])
                <div class="stat-pill">
                    Deadline <span>{{ \Carbon\Carbon::parse($goal['target_date'])->format('M d, Y') }}</span>
                </div>
                @endif
                @if($goal['months_left'] !== null)
                <div class="stat-pill">
                    Months Left <span>{{ $goal['months_left'] }}</span>
                </div>
                @endif
                @if($goal['monthly_suggested'])
                <div class="stat-pill">
                    Save/Month <span style="color:#06b6d4;">₱{{ number_format($goal['monthly_suggested'], 2) }}</span>
                </div>
                @endif
                @if($goal['monthly_percent'])
                <div class="stat-pill">
                    Monthly % Target <span>{{ $goal['monthly_percent'] }}%</span>
                </div>
                @endif
            </div>

            {{-- AI Advice box --}}
            <div class="ai-advice-box" id="advice-{{ $goal['id'] }}"></div>

            {{-- Recent contributions --}}
            @if(count($goal['contributions']) > 0)
            <div class="contributions-list">
                <p style="color:#9ca3af; font-size:0.8rem; margin-bottom:0.5rem;">Recent contributions</p>
                @foreach($goal['contributions'] as $c)
                <div class="contribution-item">
                    <span style="color:rgba(255,255,255,0.7);">
                        {{ \Carbon\Carbon::parse($c['contributed_at'])->format('M d, Y') }}
                        @if($c['notes']) — {{ $c['notes'] }} @endif
                    </span>
                    <span style="color:#10b981; font-weight:600;">+₱{{ number_format($c['amount'], 2) }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    @endif
</div>

{{-- Create Goal Modal --}}
<div class="modal-overlay" id="createModal">
    <div class="modal-box">
        <h4><i class="bi bi-piggy-bank me-2" style="color:#06b6d4;"></i>New Savings Goal</h4>
        <form method="POST" action="{{ route('savings.store') }}">
            @csrf
            <label class="form-label">Goal Name *</label>
            <input type="text" name="name" class="form-control" placeholder="e.g. Emergency Fund, New Laptop" required>

            <label class="form-label">Target Amount (₱) *</label>
            <input type="number" name="target_amount" class="form-control" placeholder="50000" min="1" step="0.01" required>

            <label class="form-label">Monthly Savings % Target</label>
            <input type="number" name="monthly_percent" class="form-control" placeholder="e.g. 20 (means 20% of income)" min="0" max="100" step="0.1">

            <label class="form-label">Target Date</label>
            <input type="date" name="target_date" class="form-control" min="{{ now()->addDay()->toDateString() }}">

            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="2" placeholder="Optional notes..."></textarea>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn-teal">Create Goal</button>
                <button type="button" class="btn-outline-teal" onclick="closeModal('createModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

{{-- Contribute Modal --}}
<div class="modal-overlay" id="contributeModal">
    <div class="modal-box">
        <h4><i class="bi bi-plus-circle me-2" style="color:#06b6d4;"></i>Add Contribution to <span id="contributeGoalName"></span></h4>
        <form method="POST" id="contributeForm">
            @csrf
            <label class="form-label">Amount (₱) *</label>
            <input type="number" name="amount" class="form-control" placeholder="1000" min="1" step="0.01" required>

            <label class="form-label">Date *</label>
            <input type="date" name="contributed_at" class="form-control" value="{{ now()->toDateString() }}" required>

            <label class="form-label">Notes</label>
            <input type="text" name="notes" class="form-control" placeholder="Optional note">

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn-teal">Add Contribution</button>
                <button type="button" class="btn-outline-teal" onclick="closeModal('contributeModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.add('show');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
    }

    function openContribute(goalId, goalName) {
        document.getElementById('contributeGoalName').textContent = goalName;
        document.getElementById('contributeForm').action = `/savings/${goalId}/contribute`;
        openModal('contributeModal');
    }

    async function getAIAdvice(goalId, goalName) {
        const box = document.getElementById(`advice-${goalId}`);
        box.style.display = 'block';
        box.textContent = '⏳ Getting AI advice for ' + goalName + '...';

        try {
            const res = await fetch(`/savings/${goalId}/ai-advice`, {
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });
            const data = await res.json();
            box.textContent = data.advice || 'No advice available.';
        } catch (e) {
            box.textContent = '⚠️ Could not get advice. Please try again.';
        }
    }

    // Close modals on outside click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        });
    });
</script>
@endpush