<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_page_renders()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Food', 'type' => 'expense', 'is_system' => false, 'user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/budgets/create');
        $response->assertStatus(200);
        $response->assertSee('New Budget');
        $response->assertSee('category_id');
        $response->assertSee('amount');
        $response->assertSee('month');
        $response->assertSee('year');
    }
}
