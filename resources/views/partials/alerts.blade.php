@if(session('success'))
<div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
  <div class="d-flex">
    <div class="toast-body">
      {{ session('success') }}
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
@endif

@if(session('error'))
<div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
  <div class="d-flex">
    <div class="toast-body">
      {{ session('error') }}
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
@endif

@if(session('warning'))
<div class="toast align-items-center text-white bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
  <div class="d-flex">
    <div class="toast-body">
      {{ session('warning') }}
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
@endif

@if($errors->any())
<div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
  <div class="d-flex">
    <div class="toast-body">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
@endif