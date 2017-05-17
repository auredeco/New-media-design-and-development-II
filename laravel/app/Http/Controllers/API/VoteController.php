<?php

namespace App\Http\Controllers\API;

use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use DB;
use CreateVotesTable;
use Ramsey\Uuid\Uuid;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vote::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vote = new Vote();
        // Create Universally Unique Identifier.
        do {
            //uuid4 creates a random uuid.
            $uuid = Uuid::uuid4()->toString(); // @see https://github.com/ramsey/uuid
        } while (DB::table(CreateVotesTable::TABLE)
            ->select(CreateVotesTable::PK)
            ->where(CreateVotesTable::PK, $uuid)
            ->exists());
        $vote->uuid = $uuid;

        // Create Checksum, assume password
        $data = $vote->getAttributes();
        ksort($data);
        $value = hash('sha512', (json_encode($data)).$vote->checksum);
        // \Log::debug([$data, $value]);
        $vote->checksum = bcrypt($value);

        $vote->voteType = $request->input('voteType');

        if($vote->voteTye == 0)
        {
            $vote->agreed = null;
            $vote->referendum_id = null;
            $vote->CandidateElection_id = $request->input('CandidateElection_id');
        } else {
            $vote->agreed = $request->input('agreed');
            $vote->referendum_id = $request->input('referendum_id');
            $vote->CandidateElection_id = null;
        }

        $vote->created_at = Carbon::now();

        $vote->save();

        return $vote;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        return "votes can not be edited";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "votes can not be deleted";
    }
}
