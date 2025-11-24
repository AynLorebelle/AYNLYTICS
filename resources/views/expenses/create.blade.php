@extends('layouts.app')

@section('title','New Expense')

@section('content')
  <h3>New Expense</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('expenses.store') }}" method="POST">
        @csrf
        @include('expenses.form')
        <button class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
@endsection
