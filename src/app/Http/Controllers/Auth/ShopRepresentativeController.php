<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopRepresentative;
use App\Http\Requests\StoreShopRepresentativeRequest;
use Illuminate\Support\Facades\Hash;

class ShopRepresentativeController extends Controller
{
    public function create()
    {
        $shops = Shop::all();
        return view('shop-edit', compact('shops'));
    }

    public function store(StoreShopRepresentativeRequest $request)
    {
        ShopRepresentative::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shop_id' => $request->shop_id,
        ]);

        return redirect()->back()->with('success', 'Shop representative created successfully.');
    }

    public function dashboard()
        {
        //必要な記述を...
            return view('shop-representative-dashboard');
        }
}
