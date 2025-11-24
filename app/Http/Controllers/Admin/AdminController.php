<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function ensureAdmin(Request $request)
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            abort(403);
        }
    }

    public function index(Request $request)
    {
        $this->ensureAdmin($request);
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit(Request $request, User $user)
    {
        $this->ensureAdmin($request);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->ensureAdmin($request);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'role' => ['required', 'in:user,admin'],
        ]);
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated');
    }

    public function destroy(Request $request, User $user)
    {
        $this->ensureAdmin($request);
        $user->delete();
        return back()->with('success', 'User deleted');
    }
}
