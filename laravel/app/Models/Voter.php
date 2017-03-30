<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     * Relates a Vote with a User
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a User with a Vote
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
