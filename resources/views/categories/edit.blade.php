@extends('layouts.app')

@section('title','Edit Category')

@section('content')
  <h3>Edit Category</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('categories.update',$category) }}" method="POST">
        @csrf @method('PATCH')
        @include('categories.form')
        <button class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
@endsection
