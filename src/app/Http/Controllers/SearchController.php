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
        $username = auth()->check() ? auth()->user()->name : null;
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
        $shops = $query->get();

        return view('index', compact('username', 'user', 'shops', 'prefectures', 'genres'));
    }
}
