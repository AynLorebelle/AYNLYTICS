@extends('layouts.app')

@section('title','Edit Expense')

@section('content')
  <h3>Edit Expense</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('expenses.update',$expense) }}" method="POST">
        @csrf @method('PATCH')
        @include('expenses.form')
        <button class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
@endsection
