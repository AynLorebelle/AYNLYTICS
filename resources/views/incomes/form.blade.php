<div class="mb-3">
  <label class="form-label">Category</label>
  <select name="category_id" class="form-select" required>
    <option value="">Choose</option>
    @foreach($categories as $c)
      <option value="{{ $c->id }}" {{ (old('category_id',$income->category_id ?? '') == $c->id) ? 'selected' : '' }}>{{ $c->name }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label class="form-label">Amount</label>
  <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount',$income->amount ?? '') }}" required>
</div>

<div class="mb-3">
  <label class="form-label">Transaction date</label>
  <input type="date" name="transaction_date" class="form-control" value="{{ old('transaction_date', optional($income->transaction_date)->format('Y-m-d') ?? '') }}" required>
</div>

<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control">{{ old('description',$income->description ?? '') }}</textarea>
</div>
