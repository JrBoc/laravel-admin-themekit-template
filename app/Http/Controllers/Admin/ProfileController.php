<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('roles.permissions')->findOrFail(auth()->id());

        return view('pages.admin.profile', [
            'user' => $user,
            'is_super_admin' => in_array('Super Admin', auth()->user()->roles->pluck('name')->toArray())
        ]);
    }
}
