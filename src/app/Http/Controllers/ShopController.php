<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        return view('show', compact('shop'));
    }
}
