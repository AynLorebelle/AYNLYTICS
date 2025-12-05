<div class="mb-3">
  <label class="form-label">Category</label>
   {{-- ADDED: id="category-select" for Choices.js to target this select --}}
  <select name="category_id" id="category-select" class="form-select" required>
    <option value="">Choose</option>
    @foreach($categories as $c)
      <option value="{{ $c->id }}" {{ (old('category_id', $expense->category_id ?? '') == $c->id) ? 'selected' : '' }}>  {{ $c->name }}</option>
    @endforeach
  </select>
  @error('category_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Amount</label>
  <input type="number" step="0.01" name="amount" class="form-control dark-input"
         value="{{ old('amount', $expense->amount ?? '') }}" required>
</div>

<div class="mb-3">
  <label class="form-label">Transaction date</label>
  <input type="date" name="transaction_date" class="form-control dark-input"
         value="{{ old('transaction_date', optional($expense->transaction_date)->format('Y-m-d') ?? '') }}" required>
</div>

<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control dark-textarea">{{ old('description', $expense->description ?? '') }}</textarea>
</div>


{{-- ========== START: CHOICES.JS CUSTOM DROPDOWN ========== --}}
{{-- This section adds the custom dropdown styling with hover effects --}}
@once
{{-- Load Choices.js CSS library --}}
<link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet">

{{-- Load Choices.js JavaScript library --}}
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

{{-- Custom styling for the dropdown --}}
<style>
/* Style the main select box */
.choices__inner {
    background-color: rgba(255,255,255,0.04) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    border-radius: 6px;
    padding: 0.75rem 1rem;
    color: #ffffff;
}

/* Style the dropdown menu container */
.choices__list--dropdown {
    background-color: #0c222b !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    border-radius: 8px;
    margin-top: 0.5rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}

/* Style each dropdown item */
.choices__list--dropdown .choices__item {
    color: #ffffff !important;
    padding: 0.75rem 1rem;
    transition: all 0.2s ease;
}

/* THIS IS YOUR GLOW HOVER EFFECT - Edit colors here to change the hover style */
.choices__list--dropdown .choices__item--selectable:hover,
.choices__list--dropdown .choices__item--selectable.is-highlighted {
    /* Background gradient on hover */
    background: linear-gradient(90deg, rgba(232, 244, 77, 0.15), rgba(232, 244, 77, 0.05)) !important;
    /* Text color on hover */
    color: #FFD166 !important;
    /* Glow effect */
    box-shadow: 
        inset 0 0 20px rgba(232, 244, 77, 0.2),
        0 0 15px rgba(232, 244, 77, 0.3);
    /* Left border accent */
    border-left: 3px solid #E8F44D;
    padding-left: calc(1rem - 3px);
}

/* Ensure text color is white for all items */
.choices__item--selectable {
    color: #ffffff !important;
}
</style>

{{-- Initialize Choices.js on the select element --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the select element by ID
        const element = document.getElementById('category-select');
        
        // Initialize Choices.js if element exists
        if (element) {
            new Choices(element, {
                searchEnabled: false,  // Disable search box
                itemSelectText: '',    // Remove "Press to select" text
                shouldSort: false      // Keep original order
            });
        }
    });
</script>
@endonce
{{-- ========== END: CHOICES.JS CUSTOM DROPDOWN ========== --}}