@extends('layouts.app')

@section('title','New Income')

@section('content')
  <h3 class="mb-3"></h3>
  <div class="card dark-card">
    <div class="card-body">
      <form action="{{ route('incomes.store') }}" method="POST">
        @csrf
        @include('incomes.form')
        <button class="btn ayn-cta"><i class="bi bi-check2 me-1"></i>Save</button>
      </form>
    </div>
  </div>
@endsection
