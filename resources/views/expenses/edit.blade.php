@extends('layouts.app')

@section('title','Edit Expense')

@section('content')
  <h3 class="mb-3">Edit Expense</h3>
  <div class="card dark-card">
    <div class="card-body">
      <form action="{{ route('expenses.update',$expense) }}" method="POST">
        @csrf @method('PATCH')
        @include('expenses.form')
        <button class="btn ayn-cta"><i class="bi bi-pencil me-1"></i>Update</button>
      </form>
    </div>
  </div>
@endsection
