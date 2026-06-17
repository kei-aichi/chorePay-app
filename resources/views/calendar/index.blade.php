<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('calendar.index', ['month' => $currentMonth->copy()->subMonth()->format('Y-m')]) }}"
                class="px-4 py-2 bg-gray-200 rounded">
                前月
            </a>

            <h1 class="text-2xl font-bold">
                {{ $currentMonth->format('Y年n月') }}
            </h1>

            <a href="{{ route('calendar.index', ['month' => $currentMonth->copy()->addMonth()->format('Y-m')]) }}"
                class="px-4 py-2 bg-gray-200 rounded">
                次月
            </a>
        </div>

        <div class="grid grid-cols-7 text-center font-bold bg-gray-100">
            <div class="py-2">日</div>
            <div class="py-2">月</div>
            <div class="py-2">火</div>
            <div class="py-2">水</div>
            <div class="py-2">木</div>
            <div class="py-2">金</div>
            <div class="py-2">土</div>
        </div>

        <div class="grid grid-cols-7 border-l border-t">
            @for ($i = 0; $i < $startOfMonth->dayOfWeek; $i++)
                <div class="h-28 border-r border-b bg-gray-50"></div>
            @endfor

            @for ($day = 1; $day <= $endOfMonth->day; $day++)
                @php
                    $date = $currentMonth->copy()->day($day)->format('Y-m-d');
                    $dayRecords = $records->get($date);
                    $count = $dayRecords?->count() ?? 0;
                    $total = $dayRecords?->sum(fn($record) => $record->task->reward) ?? 0;
                @endphp

                <a href="{{ route('calendar.show', $date) }}" class="h-28 border-r border-b p-2 hover:bg-blue-50 block">
                    <div class="font-bold">
                        {{ $day }}
                    </div>

                    @if ($count > 0)
                        <div class="mt-2 text-sm text-blue-600">
                            {{ $count }}件
                        </div>
                        <div class="text-sm text-green-600">
                            {{ $total }}円
                        </div>
                    @endif
                </a>
            @endfor
        </div>
    </div>
</x-app-layout>