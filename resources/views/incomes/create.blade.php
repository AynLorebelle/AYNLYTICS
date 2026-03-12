@extends('layouts.app')

@section('title','New Income')

@section('content')
  <h3 class="mb-3"></h3>
  <div class="card dark-card">
    <div class="card-body">
      <form action="{{ route('incomes.store') }}" method="POST">
        @csrf
        @include('incomes.form')
        
        @if($categories->isEmpty())
          <button class="btn ayn-cta2" disabled><i class="bi bi-plus-lg me-1"></i>Create Income</button>
          <div class="text-warning mt-2">Please create a category before adding an income.</div>
        @else
          <button class="btn ayn-cta"><i class="bi bi-plus-lg me-1"></i>Create Income</button>
        @endif
      </form>
    </div>
  </div>
@endsection
