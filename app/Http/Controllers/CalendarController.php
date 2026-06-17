<?php

namespace App\Http\Controllers;

use App\Models\ChoreRecord;
use Carbon\Carbon;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function index(): View
    {
        $currentMonth = request('month')
            ? Carbon::parse(request('month'))
            : now();

        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        $records = ChoreRecord::with(['child', 'task.category'])
            ->whereBetween('worked_at', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy(fn($record) => $record->worked_at->format('Y-m-d'));

        return view('calendar.index', compact(
            'currentMonth',
            'startOfMonth',
            'endOfMonth',
            'records'
        ));
    }

    public function show(string $date): View
    {
        $targetDate = Carbon::parse($date);

        $records = ChoreRecord::with(['child', 'task.category'])
            ->whereDate('worked_at', $targetDate)
            ->get();

        return view('calendar.show', compact('targetDate', 'records'));
    }
}
