@extends('layouts.app')

@section('title','New Income')

@section('content')
  <h3>New Income</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('incomes.store') }}" method="POST">
        @csrf
        @include('incomes.form')
        <button class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
@endsection
