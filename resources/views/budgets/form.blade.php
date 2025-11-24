<div class="mb-3">
  <label class="form-label">Category</label>
  <select name="category_id" class="form-select" required>
    <option value="">Choose</option>
    @foreach($categories as $c)
      <option value="{{ $c->id }}" {{ (old('category_id',$budget->category_id ?? '') == $c->id) ? 'selected' : '' }}>{{ $c->name }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label class="form-label">Amount</label>
  <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount',$budget->amount ?? '') }}" required>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Month</label>
    <input type="number" min="1" max="12" name="month" class="form-control" value="{{ old('month',$budget->month ?? '') }}" required>
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label">Year</label>
    <input type="number" name="year" class="form-control" value="{{ old('year',$budget->year ?? now()->year) }}" required>
  </div>
</div>
