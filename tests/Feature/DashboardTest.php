<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_totals_and_recent_transactions()
    {
        $user = User::factory()->create();

        // categories
        $catExpense = Category::create(['name' => 'Groceries', 'type' => 'expense', 'is_system' => false, 'user_id' => $user->id]);
        $catIncome = Category::create(['name' => 'Salary', 'type' => 'income', 'is_system' => false, 'user_id' => $user->id]);

        // current month values
        $today = now();
        $month = $today->month;
        $year = $today->year;

        // incomes: 1000 + 500 = 1500
        Income::create(['user_id' => $user->id, 'category_id' => $catIncome->id, 'amount' => 1000, 'transaction_date' => $today->format('Y-m-d')]);
        Income::create(['user_id' => $user->id, 'category_id' => $catIncome->id, 'amount' => 500, 'transaction_date' => $today->subDays(1)->format('Y-m-d')]);

        // expenses: 200 + 300 = 500
        Expense::create(['user_id' => $user->id, 'category_id' => $catExpense->id, 'amount' => 200, 'transaction_date' => now()->format('Y-m-d')]);
        Expense::create(['user_id' => $user->id, 'category_id' => $catExpense->id, 'amount' => 300, 'transaction_date' => now()->subDays(2)->format('Y-m-d')]);

        // budgets for month: 400
        Budget::create(['user_id' => $user->id, 'category_id' => $catExpense->id, 'amount' => 400, 'month' => $month, 'year' => $year]);

        // previous month data (for percent change)
        $prev = now()->startOfMonth()->subMonth();
        Income::create(['user_id' => $user->id, 'category_id' => $catIncome->id, 'amount' => 1000, 'transaction_date' => $prev->format('Y-m-d')]);
        Expense::create(['user_id' => $user->id, 'category_id' => $catExpense->id, 'amount' => 400, 'transaction_date' => $prev->format('Y-m-d')]);
        Budget::create(['user_id' => $user->id, 'category_id' => $catExpense->id, 'amount' => 0, 'month' => $prev->month, 'year' => $prev->year]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);

        // verify totals (formatted numeric strings)
        $response->assertSee('1,500.00'); // incomes
        $response->assertSee('500.00'); // expenses
        $response->assertSee('400.00'); // budgets

        // savings check (66.7% approx) and change label +6.7%
        $response->assertSee('66.7%');
        $response->assertSee('+6.7%');

        // the most recent transactions should include the amounts / names
        $response->assertSee('Groceries');
        $response->assertSee('Salary');
    }

    public function test_dashboard_handles_no_previous_month_values()
    {
        $user = User::factory()->create();

        $cat = Category::create(['name' => 'Test', 'type' => 'income', 'is_system' => false, 'user_id' => $user->id]);

        // current month only incomes
        Income::create(['user_id' => $user->id, 'category_id' => $cat->id, 'amount' => 500, 'transaction_date' => now()->format('Y-m-d')]);

        // ensure previous month has zero values

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);

        // income change should show 'New' because previous month had zero
        $response->assertSee('New');

        // recent transactions should show the income
        $response->assertSee('Test');

        // if no transactions at all encourage empty state: check with a fresh user
        $other = User::factory()->create();
        $response2 = $this->actingAs($other)->get('/dashboard');
        $response2->assertStatus(200);
        // assert a substring to avoid encoding/whitespace differences
        $response2->assertSee('You haven');
    }
}
