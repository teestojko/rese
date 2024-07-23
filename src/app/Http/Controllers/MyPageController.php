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


class MyPageController extends Controller
{
    public function userMyPage()
    {
        $username = null;
        if (auth()->check()) {
            $username = auth()->user()->name;
        }
        $user = Auth::user();
        $shops = Shop::all();
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        return view('index', compact('username','user','shops','prefectures','genres'));
    }

    public function showMyPage()
    {
        $user = Auth::user();
        $favorites = $user->favoriteShops()->with('genre', 'prefecture')->get();
        $reservations = $user->reservations()->get();
        return view('mypage',compact('user','favorites','reservations',)
        );
    }

    public function destroyReservation($id)
{
    $reservation = Reservation::find($id);
    if ($reservation && $reservation->user_id == Auth::id()) {
        $reservation->delete();
        return redirect()->route('mypage')->with('success', '予約が削除されました。');
    }

    return redirect()->route('mypage')->with('error', '予約の削除に失敗しました。');
}

}
