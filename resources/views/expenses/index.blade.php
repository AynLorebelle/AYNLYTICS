@extends('layouts.app')

@section('title','Expenses')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h3>Expenses</h3>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">New Expense</a>
  </div>

  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-dark">
        <thead>
          <tr><th>Date</th><th>Category</th><th>Amount</th><th>Description</th><th></th></tr>
        </thead>
        <tbody>
          @foreach($expenses as $e)
            <tr>
              <td>{{ $e->transaction_date->format('Y-m-d') }}</td>
              <td>{{ $e->category->name ?? '—' }}</td>
              <td class="text-end">&#8369;{{ number_format($e->amount,2) }}</td>
              <td>{{ Str::limit($e->description,50) }}</td>
              <td class="text-end">
                <a href="{{ route('expenses.show',$e) }}" class="btn btn-sm btn-outline-secondary">View</a>
                <a href="{{ route('expenses.edit',$e) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('expenses.destroy',$e) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button></form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $expenses->links() }}
    </div>
  </div>
@endsection
