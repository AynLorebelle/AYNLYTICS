<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Budget;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        
        $totalIncomes = Income::sum('amount');
        $totalExpenses = Expense::sum('amount');
        $totalBudgets = Budget::sum('amount');
        
        // Recent users
        $recentUsers = User::latest()->take(10)->get();
        
        // Users with most transactions
        $activeUsers = User::withCount(['incomes', 'expenses'])
            ->orderByDesc('incomes_count')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'totalIncomes',
            'totalExpenses',
            'totalBudgets',
            'recentUsers',
            'activeUsers'
        ));
        
    }
    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }  
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }     
}