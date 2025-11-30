<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncomeCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_income(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Salary', 'type' => 'income', 'is_system' => false, 'user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/incomes', [
            'category_id' => $category->id,
            'amount' => 1000.00,
            'transaction_date' => now()->format('Y-m-d'),
        ]);

        $response->assertRedirect('/incomes');
        $this->assertDatabaseHas('incomes', ['user_id' => $user->id, 'category_id' => $category->id, 'amount' => 1000.00]);
    }
}
