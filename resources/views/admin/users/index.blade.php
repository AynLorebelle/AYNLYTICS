@extends ('layouts.app')
@section('title', 'Users')
@section('content')
  <h3 class="mb-3">Users</h3>
  <div class="card dark-card">
    <div class="card-body">
      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->role }}</td>
              <td class="text-end">
                <div class="action-btns">
                  <a href="" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <form action="" method="POST" style="display:inline">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete user?')"><i class="bi bi-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $users->links() }}
    </div>
  </div>
@endsection