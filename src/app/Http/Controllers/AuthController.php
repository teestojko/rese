<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $username = null;
        if (auth()->check()) {
            $username = auth()->user()->name;
        }
        $user = Auth::user();

        $shops = Shop::all();
        return view('index', compact('username','user','shops'));
    }
}
