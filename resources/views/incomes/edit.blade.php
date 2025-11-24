@extends('layouts.app')

@section('title','Edit Income')

@section('content')
  <h3>Edit Income</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('incomes.update',$income) }}" method="POST">
        @csrf @method('PATCH')
        @include('incomes.form')
        <button class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
@endsection
