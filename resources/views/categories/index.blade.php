@extends('layouts.app')

@section('title','Categories')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h3>Categories</h3>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">New Category</a>
  </div>

  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-dark">
        <thead><tr><th>Name</th><th>Type</th><th>System</th><th></th></tr></thead>
        <tbody>
          @foreach($categories as $c)
            <tr>
              <td>{{ $c->name }}</td>
              <td>{{ ucfirst($c->type) }}</td>
              <td>{{ $c->is_system ? 'Yes' : 'No' }}</td>
              <td class="text-end">
                <a href="{{ route('categories.edit',$c) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('categories.destroy',$c) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button></form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $categories->links() }}
    </div>
  </div>
@endsection
