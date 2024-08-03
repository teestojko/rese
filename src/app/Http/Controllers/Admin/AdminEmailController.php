<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use App\Models\User;
use Illuminate\Http\AdminEmailRequest;
use App\Http\Controllers\Controller;

class AdminEmailController extends Controller
{
    public function showForm()
    {
        $users = User::all();

        return view('admin.send-email', compact('users'));
    }

    public function sendEmail(AdminEmailRequest $request)
    {

        $user = User::findOrFail($request->user_id);

        Mail::to($user->email)->send(new UserNotification($request->subject, $request->message));

        return redirect()->back()->with('success', 'メールが送信されました');
    }
}
