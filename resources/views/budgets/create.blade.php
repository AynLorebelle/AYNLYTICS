

@section('title','New Budget')

@section('content')
<h3 class="text-white mb-3">New Budget</h3>

<div class="card dark-card">
  <div class="card-body">
    <form action="{{ route('budgets.store') }}" method="POST">
      @csrf
      @include('budgets.form')
      <button class="btn btn-primary mt-2">Save</button>
    </form>
  </div>
</div>
@endsection
