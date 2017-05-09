<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Group;
use App\Models\Votemanager;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $groups = Group::all();
        $datetime = Carbon::now();

        return view('crud.createElection', compact('groups', 'datetime'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $closed = true;
        $time = strtotime(Carbon::now());
        $startTime = strtotime(request('startDate'). " " .request('startTime'));
        if( $startTime <= $time){
            $closed = false;
        }

        $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'startDate' => 'required|date|after_or_equal:now' ,
            'startTime' => 'required',
            'endDate' => 'required|date|after_or_equal:startDate',
            'endTime' => 'required',
            'group' => 'required',
        ]);

        //TODO votemanager_id = huidige votemanger
        Election::create([
            'name' => request('name'),
            'description' => request('description'),
            'startDate' => request('startDate') . " " .request('startTime'),
            'endDate' => request('endDate') . " " . request('endTime'),
            'group_id' => request('group'),
            'isClosed' => $closed,
            'votemanager_id' => 1,
        ]);
        return redirect('/');

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
        $election = Election::with('candidates.user')->with('candidates.party')->find($id);
        $group = Group::find($election->group_id);
        $groups = Group::all();
        return view('crud.editElection', compact('election',  'group', 'groups'));
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
        //        dd(request()->all());
        $closed = true;
        $time = strtotime(Carbon::now());

        $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'startDate' => 'required|date',
            'startTime' => 'required',
            'endDate' => 'required|date|after_or_equal:startDate',
            'endTime' => 'required',
            'group' => 'required',
        ]);
        $startTime = strtotime(request('startDate'). " " .request('startTime'));
        if( $startTime <= $time){
            $closed = false;
        }


        //TODO votemanager_id = huidige votemanger remove candidate_id
        Election::find($id)->update([
            'name' => request('name'),
            'description' => request('description'),
            'startDate' => request('startDate') . " " .request('startTime'),
            'endDate' => request('endDate') . " " . request('endTime'),
            'group_id' => request('group'),
            'isClosed' => $closed,
            'votemanager_id' => 1,
        ]);
        return redirect('/elections/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $election= Election::findOrFail($id);
        $election->delete();
        return redirect('elections');
    }
}
