<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        return view('elections', compact('elections'));
    }

    public function detail(Election $election)
    {
        return view('detail.election', compact('election'));
    }
}
