<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Group;
use App\Models\Votemanager;
use Illuminate\Http\Request;

class ElectionController extends Controller
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
                case 'open':{
                    $elections = Election::WhereOpen()->paginate(10);
                    $elections->withPath('elections?keyword=open');

                }break;
                case 'all':{
                    $elections = Election::orderBy('id','asc')->paginate(10);
                    $elections->withPath('elections?keyword=all');

                }break;
                case 'closed':{
                    $elections = Election::WhereClosed()->paginate(10);
                    $elections->withPath('elections?keyword=closed');

                }break;

                default : {
                    $elections = Election::SearchByKeyword($keyword)->paginate(10);
                    $elections->withPath('elections?keyword=' . strtolower($keyword));
                }
            }
        }
        else
        {
            $elections = Election::orderBy('id','asc')->paginate(10);
            $elections->withPath('elections?keyword=all');

        }


        return view('elections', compact('elections'));
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
        $election = Election::with('candidates.user')->with('candidates.party')->find($id);
        $group = Group::find($election->group_id);
        $votemanager = Votemanager::find($election->votemanager_id);



        return view('detail.election', compact('election','group','votemanager'));
//        return $election;

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
