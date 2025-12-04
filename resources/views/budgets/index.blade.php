@extends('layouts.app')

@section('title','Budgets')

@section('content')
<div class="d-flex justify-content-between mb-3 mt-3 align-items-center">
  <h3></h3>
  <a href="{{ route('budgets.create') }}" class="btn ayn-cta"><i class="bi bi-plus-lg me-1"></i> New Budget</a>
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
            <th>Amount</th>
            <th>Spent</th>
            <th>Remaining</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($budgets as $b)
            <tr>
              <td>{{ $b->category->name ?? '—' }}</td>
              <td>{{ $b->month }}</td>
              <td>{{ $b->year }}</td>
              <td>&#8369;{{ number_format($b->amount,2) }}</td>
              <td>&#8369;{{ number_format($b->spent ?? 0,2) }}</td>
              <td>&#8369;{{ number_format($b->remaining ?? $b->amount,2) }}</td>
              <td class="text-end">
                <div class="action-btns">
                  <a href="{{ route('budgets.edit',$b) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <form action="{{ route('budgets.destroy',$b) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')"><i class="bi bi-trash"></i></button></form>
                </div>
              </td>
            </tr>
            <tr><td colspan="7">
              <div class="progress" style="height:8px">
                <div class="progress-bar {{ $b->percent >= 100 ? 'bg-danger' : 'bg-primary' }}" role="progressbar" style="width:{{ $b->percent }}%" aria-valuenow="{{ $b->percent }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </td></tr>
          @endforeach
        </tbody>
      </table>
      {{ $budgets->links() }}
    @else
      <p class="small-muted">No budgets yet.</p>
    @endif
  </div>
</div>
@endsection
