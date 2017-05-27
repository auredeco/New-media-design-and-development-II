<?php

namespace App\Models;

use App\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referendum extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a Referendum with a Candidate
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a Referendum with a Votemanager
     */
    public function votemanager()
    {
        return $this->belongsTo(Votemanager::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a Referendum with a Group
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a Referendum with Votes
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
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
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%")
                    ->orWhere("description", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    /**
     * @param $query
     *
     * Function that returns every referendum that has a start date lower and a end date higer than today
     * and changes its status to not closed when the original is closed
     */
    public function scopeWhereOpen($query){
        $open = $query
            ->where('startDate', '<', Carbon::now())
            ->where('endDate', '>', Carbon::now());

        foreach ($open->get() as $referendum) {
            $original = $referendum->isClosed;

            if($original){
                $referendum->isClosed = false;
                $referendum->save();
            }

        }
        return $open;
    }

    /**
     * @param $query
     *
     * Function that returns every election that has a start date lower and a end date higher than today
     * and changes its status to not closed
     */
    public function scopeWhereOpenInit($query){
        $open = $query
            ->where('startDate', '<', Carbon::now())
            ->where('endDate', '>', Carbon::now());

        foreach ($open->get() as $referendum) {
            $referendum->isClosed = false;
            $referendum->save();

        }
        return $open;
    }

    /**
     * @param $query
     *
     * Function that returns every referendum that has an end date lower than today
     * and changes its status to to closed if original is not closed
     *
     */
    public function scopeWhereClosed($query){
        $closed = $query
            ->where('endDate', '<', Carbon::now());

        foreach ($closed->get() as $referendum) {
            $original = $referendum->isClosed;
            if(!$original){
                $referendum->isClosed = true;
                $referendum->save();
            }
        }
        return $closed;
    }

    /**
     * @param $query
     *
     * Function that returns every referendum that has an end date lower than today
     * and changes its status to to closed
     *
     */
    public function scopeWhereClosedInit($query){
        $closed = $query
            ->where('endDate', '<', Carbon::now());

        foreach ($closed->get() as $referendum) {
            $referendum->isClosed = true;
            $referendum->save();
        }
        return $closed;
    }
    /**
     * @param $query
     *
     * Function that returns every referendum that has a published date
     *
     */
    public function scopeWherePublished($query){
        return $query->whereNotNull('published');
    }
    /**
     * @param $query
     *
     * Function that returns every referendum that doesn't have a published date
     *
     */
    public function scopeWhereUnpublished($query){
        return $query->whereNull('published');
    }
}