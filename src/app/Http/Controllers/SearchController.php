<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Prefecture;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function filter(Request $request)
    {
        $user_name = auth()->check() ? auth()->user()->name : null;
        $user = Auth::user();
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        $query = Shop::with('prefecture', 'genre')
                    ->leftJoin('evaluations', 'shops.id', '=', 'evaluations.shop_id')
                    ->select('shops.*', DB::raw('COALESCE(AVG(evaluations.stars), 0) as average_rating'))
                    ->groupBy('shops.id');
        if ($request->filled('prefecture_id')) {
            $query->where('prefecture_id', $request->prefecture_id);
        }
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }
        if ($request->filled('shop_name')) {
            $query->where('name', 'like', '%' . $request->shop_name . '%');
        }
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'rating_desc':
                    $query->orderByDesc('average_rating')
                        ->orderByRaw('CASE WHEN average_rating = 0 THEN 1 ELSE 0 END');
                    break;
                case 'rating_asc':
                    $query->orderByRaw('CASE WHEN average_rating = 0 THEN 1 ELSE 0 END')
                        ->orderBy('average_rating');
                    break;
                case 'random':
                    $query->inRandomOrder();
                    break;
                default:
                    $query->orderBy('shops.created_at', 'desc');
            }
        } else {
            $query->orderBy('shops.created_at', 'desc');
        }
        $shops = $query->get();
        return view('index', compact('user_name', 'user', 'shops', 'prefectures', 'genres'));
    }
}
