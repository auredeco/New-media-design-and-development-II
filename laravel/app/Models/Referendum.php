<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
