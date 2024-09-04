<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Prefecture;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $prefectures = Prefecture::all();
        $genres = Genre::all();
        return view('index', compact('shops','prefectures','genres'));
    }
}
