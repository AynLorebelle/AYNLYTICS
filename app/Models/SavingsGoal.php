<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingsGoal extends Model
{
    protected $fillable = [
        'user_id', 'name', 'target_amount',
        'monthly_percent', 'target_date', 'status', 'notes'
    ];

    protected $casts = [
        'target_date' => 'date',
        'target_amount' => 'decimal:2',
        'monthly_percent' => 'decimal:2',
    ];

    public function contributions()
    {
        return $this->hasMany(SavingsContribution::class);
    }

    public function totalSaved()
    {
        return $this->contributions()->sum('amount');
    }

    public function progressPercent()
    {
        if ($this->target_amount <= 0) return 0;
        return min(round(($this->totalSaved() / $this->target_amount) * 100, 1), 100);
    }

    public function remaining()
    {
        return max($this->target_amount - $this->totalSaved(), 0);
    }
}
