@extends('layouts.app')

@section('title','Server error')

@section('content')
  <div class="text-center py-5">
    <h1 class="display-4 text-danger">Something went wrong</h1>
    <p class="lead">We're sorry — an unexpected error occurred. The team has been notified.</p>
    <a href="/" class="btn btn-primary">Return home</a>
  </div>
@endsection
