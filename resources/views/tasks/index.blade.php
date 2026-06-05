<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">
        {{ $category->name }} のタスク一覧
    </h1>

    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('categories.index') }}" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
            ← カテゴリー一覧へ
        </a>

        <a href="{{ route('tasks.create', $category) }}"
            class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
            ＋ タスク追加
        </a>
    </div>

    <ul class="mt-4 space-y-2">
        @forelse ($tasks as $task)
            <li class="bg-white p-3 shadow rounded flex justify-between">

                <div>
                    <div class="font-bold">
                        {{ $task->title }}
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ $task->done_at }}
                    </div>
                </div>

                <div class="font-bold">
                    {{ $task->amount }}円
                </div>

            </li>
            <a href="{{ route('tasks.edit', [$category, $task]) }}" class="text-yellow-500">
                編集
            </a>

            <form action="{{ route('tasks.destroy', [$category, $task]) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-500">
                    削除
                </button>
            </form>
        @empty
            <li class="text-gray-400">タスクがありません</li>
        @endforelse
    </ul>
</x-app-layout>