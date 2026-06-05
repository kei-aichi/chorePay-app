<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    //タスク一覧
    public function index(Category $category)
    {
        abort_unless($category->user_id === auth()->id(), 403);

        $tasks = $category->tasks()->get();

        return view('tasks.index', compact('category', 'tasks'));
    }
    //タスクの作成
    public function create(Category $category)
    {
        abort_unless($category->user_id === auth()->id(), 403);

        return view('tasks.create', compact('category'));
    }

    public function store(TaskRequest $request, Category $category)
    {

        Task::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'done_at' => $request->done_at,
            'user_id' => Auth::id(),
            'category_id' => $category->id,
        ]);

        return redirect()
            ->route('tasks.index', $category)
            ->with('success', 'タスクを追加しました。');
    }
    //タスクの編集
    public function edit(Category $category, Task $task)
    {
        abort_unless($category->user_id === auth()->id(), 403);
        //念の為のカテゴリー一致チェック
        abort_unless($task->category_id === $category->id, 403);

        return view('tasks.edit', compact('category', 'task'));
    }

    public function update(TaskRequest $request, Category $category, Task $task)
    {
        abort_unless($category->user_id === auth()->id(), 403);
        abort_unless($task->category_id === $category->id, 403);

        $task->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'done_at' => $request->done_at,

        ]);

        return redirect()
            ->route('tasks.index', $category)
            ->with('success', 'タスクを更新しました。');
    }

    //タスクの削除
    public function destroy(Category $category, Task $task)
    {
        abort_unless($category->user_id === auth()->id(), 403);
        abort_unless($task->category_id === $category->id, 403);

        $task->delete();

        return redirect()
            ->route('tasks.index', $category)
            ->with('success', 'タスクを削除しました');
    }
}
