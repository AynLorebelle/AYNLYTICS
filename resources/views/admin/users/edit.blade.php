@extends('layouts.app')

@section('title','Edit User')

@section('content')
  <h3>Edit User</h3>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.users.update',$user) }}" method="POST">
        @csrf @method('PATCH')
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input name="email" class="form-control" value="{{ old('email',$user->email) }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Role</label>
          <select name="role" class="form-select">
            <option value="user" {{ $user->role==='user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role==='admin' ? 'selected' : '' }}>Admin</option>
          </select>
        </div>
        <button class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
@endsection
