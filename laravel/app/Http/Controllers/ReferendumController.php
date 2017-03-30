<?php

namespace App\Http\Controllers;

use App\Models\Referendum;
use Illuminate\Http\Request;

class ReferendumController extends Controller
{
    public function index()
    {
        $referenda = Referendum::all();
        return view('referenda', compact('referenda'));
    }

    public function detail(Referendum $referendum)
    {
        return view('details.referendum', compact('referendum'));
    }
}
