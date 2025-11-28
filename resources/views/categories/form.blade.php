<div class="mb-3">
  <label class="form-label">Name</label>
  <input name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
  @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Type</label>
  <select name="type" class="form-select" required>
    <option value="expense" {{ (old('type', $category->type ?? '') == 'expense') ? 'selected' : '' }}>Expense</option>
    <option value="income" {{ (old('type', $category->type ?? '') == 'income') ? 'selected' : '' }}>Income</option>
  </select>
  @error('type')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Icon</label>
  <input name="icon" class="form-control" value="{{ old('icon', $category->icon ?? '') }}">
</div>

<div class="mb-3">
  <label class="form-label">Color</label>
  <input name="color" class="form-control" value="{{ old('color', $category->color ?? '') }}">
</div>
