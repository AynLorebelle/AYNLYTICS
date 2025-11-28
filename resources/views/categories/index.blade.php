@extends('layouts.app')

@section('title','Categories')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
    <h3 class="mb-0"></h3>
    <a href="{{ route('categories.create') }}" class="btn ayn-cta"><i class="bi bi-plus-lg me-1"></i>New Category</a>
  </div>

  <div class="card dark-card">
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-card table-borderless align-middle mb-0">
        <thead><tr><th>Name</th><th>Type</th><th>System</th><th></th></tr></thead>
        <tbody>
          @foreach($categories as $c)
            <tr>
              <td>{{ $c->name }}</td>
              <td>{{ ucfirst($c->type) }}</td>
              <td>{{ $c->is_system ? 'Yes' : 'No' }}</td>
              <td class="text-end">
                <div class="action-btns">
                  <a href="{{ route('categories.edit',$c) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <form action="{{ route('categories.destroy',$c) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')"><i class="bi bi-trash"></i></button></form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>
@endsection
