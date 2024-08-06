<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function show($id)
    {
        $shop = Shop::with(['reservations' => function ($query) {
            $query->where('reservation_date', '>=', Carbon::today()->toDateString())
                ->orderBy('reservation_date', 'asc')
                ->orderBy('reservation_time', 'asc');
        }])->findOrFail($id);

        // 現在の日付に最も近い予約を取得
        $nearestReservation = $shop->reservations->first();

        return view('show', compact('shop', 'nearestReservation'));
    }
}
