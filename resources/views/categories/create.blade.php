@extends('layouts.app')

@section('title','New Category')

@section('content')
  <h3>New Category</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        @include('categories.form')
        <button class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
@endsection
