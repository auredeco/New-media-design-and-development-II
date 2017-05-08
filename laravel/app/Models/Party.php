<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Party extends Model
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
        return $this->hasMany(Candidate::class);
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
}
