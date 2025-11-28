
@section('title','Edit Budget')

@section('content')
<h3 class="text-white mb-3">Edit Budget</h3>

<div class="card dark-card">
  <div class="card-body">
    <form action="{{ route('budgets.update',$budget) }}" method="POST">
      @csrf @method('PATCH')
      @include('budgets.form')
      <button class="btn ayn-cta mt-2"><i class="bi bi-pencil me-1"></i>Update</button>
    </form>
  </div>
</div>
@endsection

