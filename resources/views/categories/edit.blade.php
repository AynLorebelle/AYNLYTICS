@extends('layouts.app')

@section('title','Edit Category')

@section('content')
  <h3 class="mb-3">Edit Category</h3>
  <div class="card dark-card">
    <div class="card-body">
      <form action="{{ route('categories.update',$category) }}" method="POST">
        @csrf @method('PATCH')
        @include('categories.form')
        <button class="btn ayn-cta"><i class="bi bi-pencil me-1"></i>Update</button>
      </form>
    </div>
  </div>
@endsection
