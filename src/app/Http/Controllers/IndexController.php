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

class IndexController extends Controller
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
}
