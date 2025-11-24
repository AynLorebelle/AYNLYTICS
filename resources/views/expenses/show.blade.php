@extends('layouts.app')

@section('title','View Expense')

@section('content')
  <h3>Expense</h3>
  <div class="card">
    <div class="card-body">
      <p><strong>Date:</strong> {{ $expense->transaction_date->format('Y-m-d') }}</p>
      <p><strong>Category:</strong> {{ $expense->category->name ?? '—' }}</p>
      <p><strong>Amount:</strong> &#8369;{{ number_format($expense->amount,2) }}</p>
      <p><strong>Description:</strong><br>{{ $expense->description }}</p>
      <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
@endsection
