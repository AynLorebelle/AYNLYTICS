<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $categories = Category::where(function ($q) use ($user) {
            $q->where('is_system', true)->orWhere('user_id', $user->id);
        })->orderBy('type')->orderBy('name')->paginate(50);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $category = new Category();
        return view('categories.create', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        try {
            Category::create($data);
            return redirect()->route('categories.index')->with('success', 'Category created');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to create category.');
        }
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);
        try {
            $category->update($request->validated());
            return redirect()->route('categories.index')->with('success', 'Category updated');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to update category.');
        }
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        if ($category->is_system) {
            return back()->with('error', 'Cannot delete system category');
        }

        try {
            $category->delete();
            return back()->with('success', 'Category deleted');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Unable to delete category.');
        }
    }
}
