<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function toggleFavorite(Shop $shop)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to add to favorites.');
        }
        if ($user->favoriteShops->contains($shop)) {
            $user->favoriteShops()->detach($shop);
            return redirect()->back()->with('success', 'Shop removed from favorites.');
        } else {
            $user->favoriteShops()->attach($shop);
            return redirect()->back()->with('success', 'Shop added to favorites.');
        }
    }
}
