@extends('layouts.app')

@section('title','Edit Budget')

@section('content')
  <h3>Edit Budget</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('budgets.update',$budget) }}" method="POST">
        @csrf @method('PATCH')
        @include('budgets.form')
        <button class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
@endsection
