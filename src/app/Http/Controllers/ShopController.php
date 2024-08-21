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
        $userId = Auth::id();

        $shop = Shop::with(['reservations' => function ($query) use ($now, $userId) {
            $query->where('reservation_date', '>=', $now->toDateString())
                ->where('user_id', $userId)
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

        $nearest_reservation = $shop->reservations->first();

        return view('show', compact('shop', 'nearest_reservation'));
    }
}
