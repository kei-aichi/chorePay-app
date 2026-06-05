<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">カテゴリー詳細</h1>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-700">
            {{ $category->name }}
        </p>
    </div>

    <div class="mt-4">
        <a href="{{ route('categories.index') }}" class="text-blue-500">
            ← 一覧に戻る
        </a>
    </div>
</x-app-layout>