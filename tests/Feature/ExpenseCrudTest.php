<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_expense(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Test', 'type' => 'expense', 'is_system' => false, 'user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/expenses', [
            'category_id' => $category->id,
            'amount' => 123.45,
            'transaction_date' => now()->format('Y-m-d'),
        ]);

        $response->assertRedirect('/expenses');
        $this->assertDatabaseHas('expenses', ['user_id' => $user->id, 'category_id' => $category->id, 'amount' => 123.45]);
    }

    public function test_create_view_contains_transaction_date_input()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Test', 'type' => 'expense', 'is_system' => false, 'user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/expenses/create');
        $response->assertStatus(200);
        $response->assertSee('transaction_date');
    }
}
