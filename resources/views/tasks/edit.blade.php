<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">タスク編集</h1>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('tasks.update', [$category, $task]) }}">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ old('title', $task->title) }}" class="border p-2 w-full">

        <input type="number" name="amount" value="{{ old('amount', $task->amount) }}" class="border p-2 w-full mt-2">

        <input type="date" name="done_at" value="{{ old('done_at', $task->done_at) }}" class="border p-2 w-full mt-2">

        <button class="bg-green-500 text-white px-4 py-2 mt-4">
            更新
        </button>
    </form>
</x-app-layout>