<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
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
                    $parties = Party::orderBy('id','asc')->paginate(10);
                    $parties->withPath('parties?keyword=all');

                }break;


                default : {
                    $parties = Party::SearchByKeyword($keyword)->paginate(10);
                    $parties->withPath('parties?keyword=' . strtolower($keyword));
                }
            }
        }
        else
        {
            $parties = Party::orderBy('id','asc')->paginate(10);
            $parties->withPath('parties?keyword=all');

        }

        return view('parties', compact('parties'));
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
        $party = Party::find($id);
        $candidates = Candidate::with('party')->with('user')->where('party_id', $id)->paginate(10);
//        $users = $group->users()->paginate(10);


        return view('detail.party', compact('party', 'candidates'));
//        return $candidates;
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
