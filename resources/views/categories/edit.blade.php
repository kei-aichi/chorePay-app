<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">カテゴリー編集</h1>

    <div class="mb-4">
        <a href="{{ route('categories.index') }}" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
            ← 戻る
        </a>
    </div>
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PUT')

        <div>
            <label>カテゴリー名</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="border p-2 w-full">

            @error('name')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-green-500 text-white px-4 py-2 mt-4">
            更新
        </button>
    </form>
</x-app-layout>