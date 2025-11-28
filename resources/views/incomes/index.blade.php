@extends('layouts.app')

@section('title','Incomes')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
    <h3 class="mb-0"></h3>
    <a href="{{ route('incomes.create') }}" class="btn ayn-cta"><i class="bi bi-plus-lg me-1"></i>New Income</a>
  </div>

  <div class="card dark-card incomes-card ">
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-card table-borderless align-middle mb-0">
        <thead>
          <tr><th>Date</th><th>Category</th><th>Amount</th><th>Description</th><th></th></tr>
        </thead>
        <tbody>
          @foreach($incomes as $e)
            <tr>
              <td>{{ $e->transaction_date->format('Y-m-d') }}</td>
              <td>{{ $e->category->name ?? '—' }}</td>
              <td class="text-end">&#8369;{{ number_format($e->amount,2) }}</td>
              <td>{{ Str::limit($e->description,50) }}</td>
              <td class="text-end">
                <div class="action-btns">
                  <a href="{{ route('incomes.show',$e) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                  <a href="{{ route('incomes.edit',$e) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <form action="{{ route('incomes.destroy',$e) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')"><i class="bi bi-trash"></i></button></form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      </div>

      {{ $incomes->links() }}
    </div>
  </div>
@endsection
