<?php

namespace App\Providers;

 use App\Models\Expense;
 use App\Models\Income;
 use App\Models\Budget;
 use App\Models\Category;
 use App\Policies\ExpensePolicy;
 use App\Policies\IncomePolicy;
 use App\Policies\BudgetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Expense::class => ExpensePolicy::class,
        Income::class => IncomePolicy::class,
        Budget::class => BudgetPolicy::class,
        Category::class => \App\Policies\CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', fn($user) => $user->isAdmin());
    }
}
