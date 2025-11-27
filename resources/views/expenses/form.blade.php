<style>
  .dark-input, .dark-select, .dark-textarea {
    background: #1b263b;
    border: 1px solid #415a77;
    color: #e0e6ed;
  }
  .dark-input:focus, .dark-select:focus, .dark-textarea:focus {
    background: #1b263b;
    border-color: #3a86ff;
    color: #fff;
  }
  label {
    color: #e0e6ed;
  }
</style>

<div class="mb-3">
  <label class="form-label">Category</label>
  <select name="category_id" class="form-select dark-select" required>
    <option value="">Choose</option>
    @foreach($categories as $c)
      <option value="{{ $c->id }}" {{ (old('category_id',$budget->category_id ?? '') == $c->id) ? 'selected' : '' }}>
        {{ $c->name }}
      </option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label class="form-label">Amount</label>
  <input type="number" step="0.01" name="amount" class="form-control dark-input"
         value="{{ old('amount',$budget->amount ?? '') }}" required>
</div>

<div class="mb-3">
  <label class="form-label">Month</label>
  <input type="text" name="month" class="form-control dark-input"
         value="{{ old('month',$budget->month ?? '') }}" required>
</div>

<div class="mb-3">
  <label class="form-label">Year</label>
  <input type="number" name="year" class="form-control dark-input"
         value="{{ old('year',$budget->year ?? '') }}" required>
</div>
