@extends('layouts.app')

@section('title','Dashboard')

@section('content')
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5>Total Expenses (this month)</h5>
          <h3 class="text-danger">&#8369;{{ number_format($totalExpenses ?? 0,2) }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5>Total Incomes (this month)</h5>
          <h3 class="text-success">&#8369;{{ number_format($totalIncomes ?? 0,2) }}</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <h5>Spending overview</h5>
      <canvas id="spendingChart" height="120"></canvas>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h5>Budgets</h5>
      @if($budgets && $budgets->count())
        <ul class="list-group">
          @foreach($budgets as $b)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ $b->category->name ?? 'Category' }} ({{ $b->month }}/{{ $b->year }})
              <span>&#8369;{{ number_format($b->amount,2) }}</span>
            </li>
          @endforeach
        </ul>
      @else
        <p class="mb-0">No budgets set for this period.</p>
      @endif
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // Placeholder chart - replace with real data via controller
  const ctx = document.getElementById('spendingChart');
  if (ctx) {
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Expenses','Incomes'],
        datasets: [{
          data: [{{ $totalExpenses ?? 0 }}, {{ $totalIncomes ?? 0 }}],
          backgroundColor: ['#dc3545', '#28a745']
        }]
      }
    });
  }
</script>
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
