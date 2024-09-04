<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Genre;
use App\Models\Prefecture;
use Carbon\Carbon;

class MyPageController extends Controller
{
    public function userMyPage()
    {
        $user_name = null;
        if (auth()->check()) {
            $user_name = auth()->user()->name;
        }
        $user = Auth::user();
        $shops = Shop::all();
        $prefectures = Prefecture::all();
        $genres = Genre::all();
        return view('index', compact('user_name','user','shops','prefectures','genres'));
    }

    public function showMyPage($id)
    {
    $user = Auth::user();
    $favorites = $user->favoriteShops()->with('genre', 'prefecture')->get();
    $now = Carbon::now();
    $total_reservations = Reservation::where('user_id', $user->id)->count();
    $nearest_reservation = Reservation::where('user_id', $user->id)
        ->where('reservation_date', '>=', $now->toDateString())
        ->where(function ($query) use ($now) {
            $query->where('reservation_date', '>', $now->toDateString())
                ->orWhere(function ($query) use ($now) {
                    $query->where('reservation_date', $now->toDateString())
                        ->where('reservation_time', '>', $now->toTimeString());
                });
        })
        ->orderBy('reservation_date', 'asc')
        ->orderBy('reservation_time', 'asc')
        ->first();
    $all_reservations = Reservation::where('user_id', $user->id)
        ->orderBy('reservation_date', 'asc')
        ->orderBy('reservation_time', 'asc')
        ->get();
    return view('my_page', compact('user', 'favorites', 'nearest_reservation', 'all_reservations', 'total_reservations'));
    }

    public function destroyReservation($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation && $reservation->user_id == Auth::id()) {
            $shopId = $reservation->shop_id;
            $reservation->delete();
        }
        return redirect()->route('myPage', ['shop' => $shopId]);
    }
}
