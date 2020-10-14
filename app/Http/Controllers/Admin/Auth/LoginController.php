<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('pages.admin.auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
