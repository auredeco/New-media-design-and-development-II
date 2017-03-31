<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
//    public function index()
//    {
//        $groups = Group::all();
//        return view('groups', compact('groups'));
//    }
//
//    public function detail(Group $group)
//    {
//        return view('detail.group', compact('group'));
//    }

    public function index()
    {
        $groups = Group::all();
        return view('groups', compact('groups'));
    }

    public function detail(Group $group)
    {
        return view('detail.group', compact('group'));
    }
}
