<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">子供一覧</h1>

            <a href="{{ route('children.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                子供を追加
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($children->isEmpty())
            <p class="text-gray-500">まだ子供が登録されていません。</p>
        @else
            <div class="space-y-3">
                @foreach ($children as $child)
                    <div class="bg-white shadow rounded p-4 flex justify-between items-center">
                        <div class="font-bold">
                            {{ $child->name }}
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('children.edit', $child) }}" class="text-blue-600">
                                編集
                            </a>

                            <form action="{{ route('children.destroy', $child) }}" method="POST"
                                onsubmit="return confirm('削除しますか？');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-600">
                                    削除
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>