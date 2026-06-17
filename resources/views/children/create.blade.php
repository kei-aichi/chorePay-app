<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">子供を追加</h1>

        <form action="{{ route('children.store') }}" method="POST" class="bg-white shadow rounded p-6">
            @csrf

            <div class="mb-4">
                <label class="block font-bold mb-2">名前</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                    登録
                </button>

                <a href="{{ route('children.index') }}" class="px-4 py-2 bg-gray-200 rounded">
                    戻る
                </a>
            </div>
        </form>
    </div>
</x-app-layout>