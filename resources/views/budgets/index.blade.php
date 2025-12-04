@extends('layouts.app')

@section('title','Budgets')

@section('content')
<div class="d-flex justify-content-between mb-3 mt-3 align-items-center">
  <h3></h3>
  <a href="{{ route('budgets.create') }}" class="btn ayn-cta"> New Budget</a>
</div>

<div class="card dark-card ">
  <div class="card-body">
    @if($budgets->count())
      <div class="table-responsive">
      <table class="table table-card table-borderless align-middle mb-0">
        <thead>
          <tr>
            <th>Category</th>
            <th>Month</th>
            <th>Year</th>
            <th class="text-end">Amount</th>
            <th class="text-end">Spent</th>
            <th class="text-end">Remaining</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($budgets as $b)
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="rounded-circle me-2" style="width: 8px; height: 8px; background-color: {{ $b->category->color ?? '#3b82f6' }};"></div>
                  <span>{{ $b->category->name ?? '—' }}</span>
                </div>
              </td>
              <td>{{ \Carbon\Carbon::create()->month($b->month)->format('F') }}</td>
              <td>{{ $b->year }}</td>
              <td class="text-end">₱{{ number_format($b->amount,2) }}</td>
              <td class="text-end" style="color: #ef4444;">₱{{ number_format($b->spent ?? 0,2) }}</td>
              <td class="text-end" style="color: {{ ($b->remaining ?? $b->amount) < 0 ? '#ef4444' : '#10b981' }}">
                ₱{{ number_format($b->remaining ?? $b->amount,2) }}
              </td>
              <td class="text-center">
                <div class="action-btns">
                  <a href="{{ route('budgets.edit',$b) }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('budgets.destroy',$b) }}" method="POST" style="display:inline">
                    @csrf 
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this budget?')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="7" style="padding: 0.5rem 1rem 1rem 1rem;">
                <div class="progress">
                  <div class="progress-bar {{ $b->percent >= 100 ? 'bg-danger' : 'bg-primary' }}" 
                       role="progressbar" 
                       style="width:{{ min($b->percent, 100) }}%" 
                       aria-valuenow="{{ $b->percent }}" 
                       aria-valuemin="0" 
                       aria-valuemax="100">
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-3">
        {{ $budgets->links() }}
      </div>
    @else
      <div class="text-center py-5">
        <i class="bi bi-piggy-bank" style="font-size: 3rem; opacity: 0.3;"></i>
        <p class="small-muted mt-3">No budgets yet. Create your first budget to get started!</p>
      </div>
    @endif
  </div>
</div>
@endsection