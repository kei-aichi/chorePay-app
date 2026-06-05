<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">
        タスク作成（{{ $category->name }}）
    </h1>

    <div class="mb-4">
        <a href="{{ route('tasks.index', $category) }}"
            class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
            ← 戻る
        </a>
    </div>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('tasks.store', $category) }}">
        @csrf

        <div>
            <label>内容</label>
            <input type="text" name="title" value="{{ old('title') }}" class="border p-2 w-full">

        </div>

        <div class="mt-2">
            <label>金額</label>
            <input type="number" name="amount" value="{{ old('amount') }}" class="border p-2 w-full">

        </div>

        <div class="mt-2">
            <label>日付</label>
            <input type="date" name="done_at" value="{{ old('done_at') }}" class="border p-2 w-full">

        </div>

        <button class="bg-blue-500 text-white px-4 py-2 mt-4">
            保存
        </button>
    </form>
</x-app-layout>