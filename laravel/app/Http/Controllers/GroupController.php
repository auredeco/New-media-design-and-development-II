<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
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


            switch (strtolower($keyword)){
                case 'all':{
                    $groups = Group::orderBy('id','asc')->paginate(10);
                    $groups->withPath('groups?keyword=all');

                }break;


                default : {
                    $groups = Group::SearchByKeyword($keyword)->paginate(10);
                    $groups->withPath('groups?keyword=' . strtolower($keyword));
                }
            }
        }
        else
        {
            $groups = Group::orderBy('id','asc')->paginate(10);
            $groups->withPath('groups?keyword=all');

        }

        return view('groups', compact('groups'));
    }

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
        $group = Group::with('users')->find($id);
//        $users = User::with('groups')->find($id);
//        $users = $group->getPaginatedUsers();
        $users = $group->users()->paginate(10);

        return view('detail.group', compact('group', 'users'));
//        return count($users);

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
