<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword != '') {
            $users = User::SearchByKeyword($keyword)->paginate(10);
        }
//        elseif($keyword == 'male') {
//            $users = User::where('gender','male')->paginate(10);
//        }
//        elseif($keyword == 'female') {
//            $users = User::where('gender','female')->paginate(10);
//        }
        else
        {
            $users = User::orderBy('id','asc')->paginate(10);
        }

//        $users = User::orderBy('id', 'asc')->paginate(10);
        return view('users', compact('users'));


    }

//    public function index(Request $request) {
//
//        $keyword = $request->input('keyword');
//
//        if ($keyword != '') {
//            $users = User::SearchByKeyword($keyword)->paginate(15);
//        } else {
//            $users = User::orderBy('lastname','asc')->paginate(15);
//        }
//
//
//        return view('users.index', compact('users'));
//
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id) ;
        return view('detail.user', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
