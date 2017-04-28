<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_elections');
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
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
}