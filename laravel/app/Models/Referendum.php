<?php

namespace App\Models;

use App\Model;


class Referendum extends Model
{

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

    public function scopeWhereOpen($query){
        return $query->where('isClosed', false);
    }
    public function scopeWhereClosed($query){
        return $query->where('isClosed', true);
    }
    public function scopeWherePublished($query){
        return $query->whereNotNull('published');
    }
    public function scopeWhereUnpublished($query){
        return $query->whereNull('published');
    }
}
