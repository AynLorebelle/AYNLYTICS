@extends('layouts.app')

@section('title','View Income')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 mt-3">
 <h3  class="btn ayn-cta2"><i class="me-1"></i>Income Details</h3>
 <a href="{{ route('incomes.index') }}" class="btn ayn-cta"><i class="bi bi-arrow-left-lg me-1"></i>Back to Incomes</a>
</div>
  <div class="card dark-card">
    <div class="card-body">
      <h5 class="card-title">Amount: ${{ number_format($income->amount,2) }}</h5>
      <p class="card-text"><strong>Date:</strong> {{ $income->transaction_date->format('Y-m-d') }}</p>
      <p class="card-text"><strong>Category:</strong> {{ $income->category->name }}</p>
      @if($income->notes)
        <p class="card-text"><strong>Notes:</strong> {{ $income->notes }}</p>
      @endif
     
    </div>
  </div>
@endsection
