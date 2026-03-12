@extends('layouts.app')

@section('title','View Expense')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 mt-3">
 <h3  class="btn ayn-cta2"><i class="me-1"></i>Expense Details</h3>
 <a href="{{ route('expenses.index') }}" class="btn ayn-cta"><i class="bi bi-arrow-left-lg me-1"></i>Back to Expenses</a>
</div>
  <div class="card dark-card">
    <div class="card-body">
      <h5 class="card-title">Amount: ${{ number_format($expense->amount,2) }}</h5>
      <p class="card-text"><strong>Date:</strong> {{ $expense->transaction_date->format('Y-m-d') }}</p>
      <p class="card-text"><strong>Category:</strong> {{ $expense->category->name }}</p>
      @if($expense->notes)
        <p class="card-text"><strong>Notes:</strong> {{ $expense->notes }}</p>
      @endif
     
    </div>
  </div>
@endsection
