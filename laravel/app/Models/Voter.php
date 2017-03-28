<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     * Relates a vote with a user
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
}
