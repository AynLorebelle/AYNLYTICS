<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $expense = [
            'Food', 'Transport', 'Utilities', 'Rent', 'Entertainment', 'Health', 'Education', 'Others'
        ];

        $income = [
            'Salary', 'Business', 'Gift', 'Interest', 'Others'
        ];

        foreach ($expense as $name) {
            Category::firstOrCreate([
                'name' => $name,
                'type' => 'expense',
            ], [
                'is_system' => true,
            ]);
        }

        foreach ($income as $name) {
            Category::firstOrCreate([
                'name' => $name,
                'type' => 'income',
            ], [
                'is_system' => true,
            ]);
        }
    }
}
