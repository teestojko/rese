<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShopRepresentative;
use Illuminate\Support\Facades\Hash;

class ShopRepresentativeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.shop_representative_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('shop_representative')->attempt($credentials)) {
            return redirect()->route('shop_representative.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

