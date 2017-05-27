<?php

namespace App\Models;

use App\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Election extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_elections')->withPivot('score', 'id', 'approved');
    }

    /**
     * @param $query
     * @param $keyword
     * @return mixed
     *
     * Filter function that returns query from database by given keyword
     */
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE", "%$keyword%")
                    ->orWhere("description", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    /**
     * @param $query
     *
     * Function that returns every election that has a start date lower and a end date higer than today
     * and changes its status to not closed
     */
    public function scopeWhereOpenInit($query)
    {
        $open = $query
            ->with('candidates')
            ->where('startDate', '<', Carbon::now())
            ->where('endDate', '>', Carbon::now());

//        loop all elections from $query and change their status
        foreach ($open->get() as $election) {
            $election->isClosed = false;
            $election->save();

        }
        return $open;
    }

    /**
     * @param $query
     * @return mixed
     *
     * Same function as previous function but only changes the status when previous state was closed
     */
    public function scopeWhereOpen($query)
    {
        $open = $query
            ->with('candidates')
            ->where('startDate', '<', Carbon::now())
            ->where('endDate', '>', Carbon::now());

//        loop all elections from query
        foreach ($open->get() as $election) {
            $original = $election->isClosed;
//            change status if original is closed
            if ($original) {
                $election->isClosed = false;
                $election->save();
            }

        }
        return $open;
    }


    /**
     * @param $query
     * @return mixed
     *
     * Function that returns all elections where the end date has passed
     *
     * We set their status to closed and calculate the score of each candidate
     */
    public function scopeWhereClosedInit($query)
    {
        $closed = $query
            ->with('candidates')
            ->where('endDate', '<', Carbon::now());

//        loop all elections from query and change their status
        foreach ($closed->get() as $election) {
            $election->isClosed = true;
            $election->save();
            $candidates = $election->candidates;

//            loop all candidates
            foreach ($candidates as $candidate) {
//                count their votes
                $score = Vote::where('CandidateElection_id', '=', $candidate->pivot->id)->count();

//                replace the old score
                $canEl = Candidate_election::find($candidate->pivot->id);
                $canEl->score = $score;
                $canEl->save();
            }

        }
        return $closed;

    }

    /**
     * @param $query
     * @return mixed
     *
     * Function that returns $query with all elections that haven't begon + change their status
     */
    public function scopeComing($query)
    {
        $coming = $query->with('candidates')->where('startDate', '>', Carbon::now());
//        change status
        foreach ($coming->get() as $election) {
            $election->isClosed = true;
            $election->isComing = true;
            $election->save();
        }
        return $coming;
    }

    /**
     * @param $query
     * @return mixed
     *
     * Function that returns all elections where the end date has passed
     *
     * We set their status to closed and calculate the score of each candidate
     */
    public function scopeWhereClosed($query)
    {
        $closed = $query
            ->with('candidates')
            ->where('endDate', '<', Carbon::now());
//        loop elections in $query
        foreach ($closed->get() as $election) {
            $original = $election->isClosed;

//            change status if original is open
            if (!$original) {
                $election->isClosed = true;
                $election->save();
                $candidates = $election->candidates;

//                loop candidates
                foreach ($candidates as $candidate) {

//                    count their score
                    $score = Vote::where('CandidateElection_id', '=', $candidate->pivot->id)->count();

                    //replace the old score
                    $canEl = Candidate_election::find($candidate->pivot->id);
                    $canEl->score = $score;
                    $canEl->save();
                }
            }
        }
        return $closed;

    }

}