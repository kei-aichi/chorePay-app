<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();


        $weeklyTotal = Task::where('user_id', auth()->id())
            ->whereBetween('done_at', [$startOfWeek, $endOfWeek])
            ->sum('amount');

        $categoryTotals = Task::selectRaw('category_id, SUM(amount) as total')
            ->where('user_id', auth()->id())
            ->whereBetween('done_at', [$startOfWeek, $endOfWeek])
            ->groupBy('category_id')
            ->with('category')
            ->get();

        return view('dashboard', compact('weeklyTotal', 'categoryTotals'));


    }
}
