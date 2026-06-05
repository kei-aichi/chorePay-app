<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">カテゴリー一覧</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categories.create') }}" class="text-blue-500">
        + 新規作成
    </a>

    <ul class="mt-4 space-y-2">
        @forelse($categories as $category)
            <li class="p-2 bg-white shadow rounded flex justify-between">
                <span>{{ $category->name }}</span>
                <ul class="mt-2 space-y-1">

                    {{-- ヘッダー（見やすさ用・任意） --}}
                    <li class="text-xs text-gray-400 flex justify-between px-2">
                        <span>日付</span>
                        <span>タスク</span>
                        <span>金額</span>
                    </li>

                    @forelse ($category->tasks as $task)
                        <li class="text-sm text-gray-700 flex justify-between px-2">

                            {{-- 日付 --}}
                            <span class="w-1/3">
                                {{ $task->done_at }}
                            </span>

                            {{-- タスク名 --}}
                            <span class="w-1/3 text-center">
                                {{ $task->title }}
                            </span>

                            {{-- 金額 --}}
                            <span class="w-1/3 text-right font-bold">
                                {{ $task->amount }}円
                            </span>

                        </li>
                    @empty
                        <li class="text-gray-400 text-sm px-2">
                            タスクなし
                        </li>
                    @endforelse

                </ul>
                <a href="{{ route('tasks.index', $category) }}" class="text-blue-500">
                    詳細
                </a>
                <div class="space-x-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500">
                        編集
                    </a>

                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">
                            削除
                        </button>
                    </form>
                </div>
            </li>
        @empty
            <li class="text-gray-500">カテゴリーがありません</li>
        @endforelse
    </ul>
</x-app-layout>