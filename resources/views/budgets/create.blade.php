@extends('layouts.app')

@section('title','New Budget')

@section('content')
  <h3>New Budget</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('budgets.store') }}" method="POST">
        @csrf
        @include('budgets.form')
        <button class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
@endsection
