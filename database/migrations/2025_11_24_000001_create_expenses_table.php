<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->date('transaction_date');
            $table->timestamps();

            $table->index(['user_id', 'category_id', 'transaction_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
