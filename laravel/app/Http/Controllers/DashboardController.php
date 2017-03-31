<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Group;
use App\Models\Party;
use App\Models\Referendum;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $all = [
            User::all()->take(10),
            Group::all(),
            Party::all(),
            Referendum::all()->take(10),
            Election::all()->take(10),
        ];


        return view('dashboard', compact('all'));
    }
}
