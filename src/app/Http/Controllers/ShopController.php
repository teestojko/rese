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
    $now = Carbon::now();

    $shop = Shop::with(['reservations' => function ($query) use ($now) {
        $query->where('reservation_date', '>=', $now->toDateString())
            ->where(function ($query) use ($now) {
                $query->where('reservation_date', '>', $now->toDateString())
                    ->orWhere(function ($query) use ($now) {
                        $query->where('reservation_date', $now->toDateString())
                            ->where('reservation_time', '>', $now->toTimeString());
                    });
            })
            ->orderBy('reservation_date', 'asc')
            ->orderBy('reservation_time', 'asc');
    }])->findOrFail($id);

    $nearestReservation = $shop->reservations->first();

    return view('show', compact('shop', 'nearestReservation'));
}
}
