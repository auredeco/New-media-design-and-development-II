<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     * Relates a Candidate with a User
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a Candidate with a Party
     */
    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a Candidate with Referendums
     */
    public function referendums()
    {
        return $this->hasMany(Referendum::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     *
     */
    public function elections()
    {
        return $this->belongsToMany(Election::class, 'candidate_elections');
    }
}
