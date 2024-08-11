<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

$admin = Admin::where('email', $credentials['email'])->first();
    if (!$admin) {
        return back()->withErrors([
            'email' => 'No account found with that email address.',
        ]);
    }

    if (!Hash::check($credentials['password'], $admin->password)) {
        return back()->withErrors([
            'password' => 'Incorrect password.',
        ]);
    }

            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.dashboard');
            }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
