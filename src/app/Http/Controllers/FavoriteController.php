<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $shop = Shop::find($request->shop_id);
        $user = auth()->user();

        if ($shop && $user) {
            $user->favoriteShops()->syncWithoutDetaching([$shop->id]);

            return redirect()->back()->with('success', 'Shop added to favorites!');
        }

        return redirect()->back()->with('error', 'Failed to add shop to favorites.');
    }
}
