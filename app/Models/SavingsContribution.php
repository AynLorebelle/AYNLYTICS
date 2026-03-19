<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingsContribution extends Model
{
    protected $fillable = [
        'savings_goal_id', 'user_id', 'amount',
        'contributed_at', 'notes'
    ];

    protected $casts = [
        'contributed_at' => 'date',
        'amount' => 'decimal:2',
    ];

    public function goal()
    {
        return $this->belongsTo(SavingsGoal::class, 'savings_goal_id');
    }
}