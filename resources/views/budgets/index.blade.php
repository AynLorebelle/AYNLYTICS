@extends('layouts.app')

@section('title','Budgets')

@section('content')
<style>
  .dark-card {
    background: #0d1b2a;
    border: 1px solid #1b263b;
    border-radius: 12px;
    color: #e0e6ed;
  }
  .dark-table thead th {
    background: #1b263b;
    color: #e0e6ed;
  }
  .dark-table tbody tr {
    border-bottom: 1px solid #1b263b;
  }
  .btn-primary {
    background: #3a86ff;
    border: none;
  }
  .btn-outline-primary {
    border-color: #3a86ff;
    color: #3a86ff;
  }
  .btn-outline-primary:hover {
    background: #3a86ff;
    color: #fff;
  }
  .btn-outline-danger {
    border-color: #ff4d6d;
    color: #ff4d6d;
  }
  .btn-outline-danger:hover {
    background: #ff4d6d;
    color: white;
  }
</style>

<div class="d-flex justify-content-between mb-3">
  <h3 class="text-white">Budgets</h3>
  <a href="{{ route('budgets.create') }}" class="btn btn-primary">New Budget</a>
</div>

<div class="card dark-card">
  <div class="card-body">
    @if($budgets->count())
      <table class="table dark-table text-white">
        <thead>
          <tr>
            <th>Category</th>
            <th>Month</th>
            <th>Year</th>
            <th class="text-end">Amount</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($budgets as $b)
            <tr>
              <td>{{ $b->category->name ?? '—' }}</td>
              <td>{{ $b->month }}</td>
              <td>{{ $b->year }}</td>
              <td class="text-end">&#8369;{{ number_format($b->amount,2) }}</td>
              <td class="text-end">
                <a href="{{ route('budgets.edit',$b) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('budgets.destroy',$b) }}" method="POST" style="display:inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $budgets->links() }}
    @else
      <p style="color:white">No budgets yet.</p>
    @endif
  </div>
</div>
@endsection
