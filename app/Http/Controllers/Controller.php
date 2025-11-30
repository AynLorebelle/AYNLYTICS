<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Helper: get categories available for the current user
     * @param string|null $type 'expense'|'income' or null for both
     */
    protected function categoriesForUser(?string $type = null)
    {
        $user = auth()->user();

        $query = \App\Models\Category::where(function ($q) use ($user) {
            $q->where('is_system', true)->orWhere('user_id', $user->id);
        });

        if ($type) {
            $query->where('type', $type);
        }

        return $query->orderBy('type')->orderBy('name')->get();
    }
}
