<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     * Relates a candidate with a user
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function party()
    {
        return $this->belongsTo(Party::class, 'id');
    }
}
