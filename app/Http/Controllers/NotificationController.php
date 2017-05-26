<?php

namespace App\Http\Controllers;

use Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('');
        return view('notification.index', compact('user'));
    }

}
