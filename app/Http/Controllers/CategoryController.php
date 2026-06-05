<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->latest()->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);
        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリーを作成しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        abort_unless($category->user_id === auth()->id(), 403);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //他人のデータ防止
        abort_unless($category->user_id === auth()->id(), 403);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        abort_unless($category->user_id === auth()->id(), 403);

        $category->update([
            'name' => $request->name,

        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリーを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        abort_unless($category->user_id === auth()->id(), 403);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリーを削除しました。');
    }
}
