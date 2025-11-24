@extends('layouts.app')

@section('title','Budgets')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h3>Budgets</h3>
    <a href="{{ route('budgets.create') }}" class="btn btn-primary">New Budget</a>
  </div>

  <div class="card">
    <div class="card-body">
      @if($budgets->count())
        <table class="table">
          <thead><tr><th>Category</th><th>Month</th><th>Year</th><th>Amount</th><th></th></tr></thead>
          <tbody>
            @foreach($budgets as $b)
              <tr>
                <td>{{ $b->category->name ?? '—' }}</td>
                <td>{{ $b->month }}</td>
                <td>{{ $b->year }}</td>
                <td class="text-end">&#8369;{{ number_format($b->amount,2) }}</td>
                <td class="text-end">
                  <a href="{{ route('budgets.edit',$b) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                  <form action="{{ route('budgets.destroy',$b) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button></form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <p>No budgets yet.</p>
      @endif
    </div>
  </div>
@endsection
