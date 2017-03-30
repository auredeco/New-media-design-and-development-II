<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function detail(User $user)
    {
        return view('details.user', compact('user'));
    }
}
