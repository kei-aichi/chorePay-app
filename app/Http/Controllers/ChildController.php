<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChildController extends Controller
{
    public function index(): View
    {
        $children = Auth::user()
            ->children()
            ->latest()
            ->get();

        return view('children.index', compact('children'));
    }

    public function create(): View
    {
        return view('children.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Auth::user()->children()->create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('children.index')
            ->with('success', '子供を登録しました。');
    }

    public function edit(Child $child): View
    {
        abort_if($child->user_id !== Auth::id(), 403);

        return view('children.edit', compact('child'));
    }

    public function update(Request $request, Child $child): RedirectResponse
    {
        abort_if($child->user_id !== Auth::id(), 403);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $child->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('children.index')
            ->with('success', '子供を更新しました。');
    }

    public function destroy(Child $child): RedirectResponse
    {
        abort_if($child->user_id !== Auth::id(), 403);

        $child->delete();

        return redirect()
            ->route('children.index')
            ->with('success', '子供を削除しました。');
    }
}