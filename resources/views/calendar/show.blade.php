<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="mb-6">
            <a href="{{ route('calendar.index', ['month' => $targetDate->format('Y-m')]) }}" class="text-blue-600">
                ← カレンダーに戻る
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-6">
            {{ $targetDate->format('Y年n月j日') }} のお手伝い
        </h1>

        @if ($records->isEmpty())
            <p class="text-gray-500">
                この日のお手伝いはありません。
            </p>
        @else
            <div class="space-y-4">
                @foreach ($records->groupBy('child.name') as $childName => $childRecords)
                    <div class="bg-white shadow rounded p-4">
                        <h2 class="text-lg font-bold mb-3">
                            {{ $childName }}
                        </h2>

                        <table class="w-full border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-3 py-2 text-left">カテゴリー</th>
                                    <th class="border px-3 py-2 text-left">詳細</th>
                                    <th class="border px-3 py-2 text-right">金額</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($childRecords as $record)
                                    <tr>
                                        <td class="border px-3 py-2">
                                            {{ $record->task->category->name }}
                                        </td>
                                        <td class="border px-3 py-2">
                                            {{ $record->task->name }}
                                        </td>
                                        <td class="border px-3 py-2 text-right">
                                            {{ $record->task->reward }}円
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-right font-bold mt-3">
                            小計：{{ $childRecords->sum(fn($record) => $record->task->reward) }}円
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-right text-xl font-bold mt-6">
                合計：{{ $records->sum(fn($record) => $record->task->reward) }}円
            </div>
        @endif
    </div>
</x-app-layout>