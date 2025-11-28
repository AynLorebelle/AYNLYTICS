@extends('layouts.app')

@section('title','Edit Income')

@section('content')
  <h3 class="mb-3">Edit Income</h3>
  <div class="card dark-card">
    <div class="card-body">
      <form action="{{ route('incomes.update',$income) }}" method="POST">
        @csrf @method('PATCH')
        @include('incomes.form')
        <button class="btn ayn-cta"><i class="bi bi-pencil me-1"></i>Update</button>
      </form>
    </div>
  </div>
@endsection
