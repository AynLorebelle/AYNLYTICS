@extends('layouts.app')

@section('title','Edit User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 mt-3">
  <h3 class="btn ayn-cta">Edit User</h3>
  </div>
  <div class="card dark-card">
    <div class="card-body">
      <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Role</label>
          <select name="role" class="form-select" required>
            <option value="user" {{ old('role',$user->role) == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role',$user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
        </div>
        <button class="btn ayn-cta"><i class="bi bi-check2 me-1"></i>Update</button>
      </form>
    </div>
  </div>
@endsection
