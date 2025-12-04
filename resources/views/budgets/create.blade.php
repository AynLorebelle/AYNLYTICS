
@extends('layouts.app')

@section('title','New Budget')

@section('content')
<h3 class="text-white mb-3"></h3>

<div class="card dark-card">
  <div class="card-body">
    <form action="{{ route('budgets.store') }}" method="POST">
      @csrf
      @include('budgets.form')
      <button class="btn ayn-cta mt-2"><i class="bi bi-check2 me-1"></i>Save</button>
    </form>
  </div>
</div>
@endsection
