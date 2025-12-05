<div class="mb-3">
  <label class="form-label">Name</label>
  <input name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
  @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Type</label>
   {{-- ADDED: id="category-select" for Choices.js to target this select --}}
  <select name="type" id="category-select" class="form-select" required>
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
