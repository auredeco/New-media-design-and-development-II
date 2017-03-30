<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function index()
    {
        $parties = Party::all();
        return view('parties', compact('parties'));
    }

    public function detail(Party $party)
    {
        return view('details.party', compact('party'));
    }
}
