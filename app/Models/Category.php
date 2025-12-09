<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'is_system',
        'user_id',
    ];

    protected $casts = [
        'is_system' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function isSystem(): bool
    {
        return (bool) $this->is_system;
    }
}
