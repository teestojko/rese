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
        $user = Auth::user();
        $favorites = $user->favoriteShops()->with('genre', 'prefecture')->get();
        $reservations = $user->reservations()->get();
        return view('mypage',compact('user','favorites','reservations',)
        );
    }
}
