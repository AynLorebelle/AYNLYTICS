<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $filter = $request->get('filter', 'all');
        
        // Get recent transactions (same logic as dashboard)
        $rawExpenses = Expense::where('user_id', $user->id)
            ->with('category')
            ->orderByDesc('transaction_date')
            ->take(20)
            ->get();
            
        $rawIncomes = Income::where('user_id', $user->id)
            ->with('category')
            ->orderByDesc('transaction_date')
            ->take(20)
            ->get();
        
        $rawBudget = Budget::where('user_id', $user->id)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->first();
        
        $rawCategories = Category::where('user_id', $user->id)->get();

        $transactions = collect();

        // Add expenses to transactions collection
        foreach ($rawExpenses as $e) {
            $transactions->push([
                'id' => $e->id,
                'type' => 'expense',
                'name' => $e->description ?: ($e->category->name ?? 'Expense'),
                'category' => $e->category->name ?? null,
                'amount' => (float) $e->amount,
                'transaction_date' => $e->transaction_date,
                'created_at' => $e->created_at,
            ]);
        }

        // Add incomes to transactions collection
        foreach ($rawIncomes as $i) {
            $transactions->push([
                'id' => $i->id,
                'type' => 'income',
                'name' => $i->description ?: ($i->category->name ?? 'Income'),
                'category' => $i->category->name ?? null,
                'amount' => (float) $i->amount,
                'transaction_date' => $i->transaction_date,
                'created_at' => $i->created_at,
            ]);
        }

        foreach($rawBudget ? [$rawBudget] : [] as $b) {
            $transactions->push([
                'id' => $b->id,
                'type' => 'budget',
                'name' => 'Budget Set',
                'category' => null,
                'amount' => (float) $b->amount,
                'transaction_date' => Carbon::create($b->year, $b->month, 1),
                'created_at' => $b->created_at,
            ]);
        }
        
        foreach ($rawCategories as $c) {
            $transactions->push([
                'id' => $c->id,
                'type' => 'category',
                'name' => $c->name,
                'category' => null,
                'amount' => 0,
                'transaction_date' => $c->created_at,
                'created_at' => $c->created_at,
            ]);
        }

        // Sort by most recent
        $allTransactions = $transactions->sortByDesc('transaction_date');

        // Apply filter
        if ($filter === 'income') {
            $allTransactions = $allTransactions->where('type', 'income');
        } elseif ($filter === 'expense') {
            $allTransactions = $allTransactions->where('type', 'expense');
        } elseif ($filter === 'budget') {
            $allTransactions = $allTransactions->where('type', 'budget');
        } elseif ($filter === 'category') {
            $allTransactions = $allTransactions->where('type', 'category');
        }

        // Take top 20 for notifications
        $filteredTransactions = $allTransactions->take(20)->values();
        
        // Transform transactions into notifications
        $notifications = $filteredTransactions->map(function($transaction) {
            $date = Carbon::parse($transaction['transaction_date']);
            $createdAt = Carbon::parse($transaction['created_at']);
            
            if ($transaction['type'] === 'income') {
                return [
                    'id' => $transaction['id'],
                    'type' => 'income',
                    'icon' => 'success',
                    'icon_class' => 'bi-cash-coin',
                    'title' => 'Income Received',
                    'message' => "{$transaction['name']} of ₱" . number_format($transaction['amount'], 2) . " has been added to your account.",
                    'time' => $date->diffForHumans(),
                    'is_unread' => $createdAt->isToday(), // Mark as unread if created today
                    'category' => $transaction['category'],
                    'amount' => $transaction['amount'],
                    'transaction_date' => $transaction['transaction_date']
                ];
            } 
            
            else if ($transaction['type'] === 'expense') {
                // Check if it's a large expense (over ₱5,000)
                $isLarge = $transaction['amount'] > 5000;
                
                $message = "An expense of ₱" . number_format($transaction['amount'], 2) . " was recorded";
                if ($transaction['category']) {
                    $message .= " in {$transaction['category']} category";
                }
                $message .= ".";
                
                return [
                    'id' => $transaction['id'],
                    'type' => 'expense',
                    'icon' => $isLarge ? 'warning' : 'info',
                    'icon_class' => $isLarge ? 'bi-exclamation-triangle-fill' : 'bi-credit-card',
                    'title' => $isLarge ? 'Large Expense Detected' : 'New Expense',
                    'message' => $message,
                    'time' => $date->diffForHumans(),
                    'is_unread' => $createdAt->isToday(), // Mark as unread if created today
                    'category' => $transaction['category'],
                    'amount' => $transaction['amount'],
                    'transaction_date' => $transaction['transaction_date']
                ];
            }
            else if ($transaction['type'] === 'budget') {
                return [
                    'id' => $transaction['id'],
                    'type' => 'budget',
                    'icon' => 'primary',
                    'icon_class' => 'bi-pie-chart-fill',
                    'title' => 'Budget Set',
                    'message' => "A budget of ₱" . number_format($transaction['amount'], 2) . " has been set for " . Carbon::parse($transaction['transaction_date'])->format('F Y') . ".",
                    'time' => $date->diffForHumans(),
                    'is_unread' => $createdAt->isToday(),
                    'category' => null,
                    'amount' => $transaction['amount'],
                    'transaction_date' => $transaction['transaction_date']
                ];
            }
            else if ($transaction['type'] === 'category') {
                return [
                    'id' => $transaction['id'],
                    'type' => 'category',
                    'icon' => 'secondary',
                    'icon_class' => 'bi-tags-fill',
                    'title' => 'New Category Added',
                    'message' => "A new category '{$transaction['name']}' has been added to your categories.",
                    'time' => $date->diffForHumans(),
                    'is_unread' => $createdAt->isToday(),
                    'category' => null,
                    'amount' => 0,
                    'transaction_date' => $transaction['transaction_date']
                ];
            }
        });
        
        // Get unread count (will be 0 after visiting this page)
        $unreadCount = 0; // Always 0 on notifications page
        
        return view('notifications.index', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
            'filter' => $filter,
        ]);
    }
    
    public function markAllRead()
    {
        // Simple implementation - just redirect back
        // The badge will show 0 because we're counting today's transactions
        // and when user visits notifications, they've "seen" them
        return redirect()->route('notifications')->with('success', 'All notifications marked as read');
    }
    
    public function markAsRead($id)
    {
        return redirect()->route('notifications')->with('success', 'Notification marked as read');
    }
    public function markAsUnread($id)
    {
        return redirect()->route('notifications')->with('success', 'Notification marked as unread');
    }
    
    public function getUnreadCount(Request $request)
    {
        $user = $request->user();
        
        // Count transactions created today
        $count = Expense::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->count() 
            + Income::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->count();
        
        return response()->json(['count' => $count]);
    }
}