<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Prefecture;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function filter(Request $request)
    {
        $user_name = auth()->check() ? auth()->user()->name : null;
        $user = Auth::user();
        $prefectures = Prefecture::all();
        $genres = Genre::all();
        $query = Shop::query();
        if ($request->filled('prefecture_id')) {
            $query->where('prefecture_id', $request->prefecture_id);
        }
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }
        if ($request->filled('shop_name')) {
        $query->where('name', 'like', $request->shop_name . '%');
        }
        $shops = $query->get();
        return view('index', compact('user_name', 'user', 'shops', 'prefectures', 'genres'));
    }
}
