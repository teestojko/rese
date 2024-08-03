<?php

namespace App\Http\Controllers\ShopRepresentative;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Http\ShopCreateEditRequest;
use App\Http\Controllers\Controller;

class ShopCreateEditController extends Controller
{

    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        return view('representative/shop-update', compact('shop'));
    }

    public function update(ShopCreateEditRequest $request, $id)
    {

        $shop = Shop::findOrFail($id);
        $shop->update([
            'name' => $request->name,
            'image_path' => $request->image_path,
            'prefecture' => $request->prefecture,
            'genre' => $request->genre,
            'detail' => $request->detail,
        ]);

        return redirect()->route('shop-representative.dashboard')->with('success', 'Shop updated successfully.');
    }
}
