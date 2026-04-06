<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function show_dashboard()
    {
        $now = Carbon::now();
        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        $totals = CreditCard::leftJoin('expenses', 'expenses.card', '=', 'credit_cards.name')
            ->select(
                'credit_cards.name',
                'credit_cards.due_day',
                DB::raw('COALESCE(SUM(expenses.amount), 0) as total_amount')
            )
            ->where(function ($query) use ($month, $year) {
                $query->whereMonth('expenses.date', $month)
                    ->whereYear('expenses.date', $year);
            })
            ->groupBy('credit_cards.name', 'credit_cards.due_day')
            ->get();

        return view('dashboard', [
            'totals' => $totals,
            'month' => $month, // two-digit month, e.g., "04"
            'year' => $year,
        ]);

    }
}
