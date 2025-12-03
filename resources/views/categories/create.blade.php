@extends('layouts.app')

@section('title','New Category')

@section('content')
  <h3 class="mb-3"></h3>
  <div class="card dark-card">
    <div class="card-body categories-card">
      <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        @include('categories.form')
        <button class="btn ayn-cta" ><i class="bi bi-check2 me-1"></i>Save</button>
      </form>
    </div>
  </div>
@endsection
