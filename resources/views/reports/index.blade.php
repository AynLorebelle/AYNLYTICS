@extends('layouts.app')

@section('title','Reports')

@section('content')
  <h3>Reports</h3>

  <form class="row g-3 mb-3">
    <div class="col-md-4">
      <label class="form-label">From</label>
      <input type="date" name="from" class="form-control" value="{{ request('from') }}">
    </div>
    <div class="col-md-4">
      <label class="form-label">To</label>
      <input type="date" name="to" class="form-control" value="{{ request('to') }}">
    </div>
    <div class="col-md-4 align-self-end">
      <button class="btn btn-primary">Filter</button>
    </div>
  </form>

  <div class="row">
    <div class="col-md-6">
      <div class="card mb-3">
        <div class="card-body">
          <h5>Expenses</h5>
          <table class="table">
            <thead><tr><th>Date</th><th>Category</th><th>Amount</th></tr></thead>
            <tbody>
              @foreach($expenses as $e)
                <tr>
                  <td>{{ $e->transaction_date->format('Y-m-d') }}</td>
                  <td>{{ $e->category->name ?? '—' }}</td>
                  <td class="text-end">&#8369;{{ number_format($e->amount,2) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $expenses->withQueryString()->links() }}
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-3">
        <div class="card-body">
          <h5>Incomes</h5>
          <table class="table">
            <thead><tr><th>Date</th><th>Category</th><th>Amount</th></tr></thead>
            <tbody>
              @foreach($incomes as $i)
                <tr>
                  <td>{{ $i->transaction_date->format('Y-m-d') }}</td>
                  <td>{{ $i->category->name ?? '—' }}</td>
                  <td class="text-end">&#8369;{{ number_format($i->amount,2) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $incomes->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
