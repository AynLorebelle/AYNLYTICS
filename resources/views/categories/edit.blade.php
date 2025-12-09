@extends('layouts.app')

@section('title','Edit Category')

@section('content')
  <div class=" d-flex justify-content-left align-items-center mb-3 mt-3">
     <h3 class="btn ayn-cta"><i class="bi me-1"></i>Edit Category</h3>
</div>
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
