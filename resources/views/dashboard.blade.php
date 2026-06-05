<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">
        ChorePay ダッシュボード
    </h1>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-lg font-semibold">
            今週のお小遣い合計
        </h2>

        <p class="text-3xl font-bold mt-2">
            {{ number_format($weeklyTotal) }}円
        </p>
    </div>
    <div class="bg-white shadow rounded p-6 mt-6">
        <h2 class="text-lg font-semibold mb-4">
            カテゴリー別合計
        </h2>
        <ul>
            @foreach ($categoryTotals as $item)
                <li class="flex justify-between border-b py-2">
                    <span>{{ $item->category->name }}</span>
                    <span>{{ number_format($item->total) }}円</span>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>