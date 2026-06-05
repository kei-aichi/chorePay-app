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