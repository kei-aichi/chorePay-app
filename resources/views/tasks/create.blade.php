<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">
        タスク作成（{{ $category->name }}）
    </h1>

    <form method="POST" action="{{ route('tasks.store', $category) }}">
        @csrf

        <div>
            <label>内容</label>
            <input type="text" name="title" value="{{ old('title') }}" class="border p-2 w-full">

            @error('title')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-2">
            <label>金額</label>
            <input type="number" name="amount" value="{{ old('amount') }}" class="border p-2 w-full">

            @error('amount')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-2">
            <label>日付</label>
            <input type="date" name="done_at" value="{{ old('done_at') }}" class="border p-2 w-full">

            @error('done_at')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 mt-4">
            保存
        </button>
    </form>
</x-app-layout>