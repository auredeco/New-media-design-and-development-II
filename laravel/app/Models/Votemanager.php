<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votemanager extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a Votemanager with Referendums
     */
    public function referendums()
    {
        return $this->hasMany(Referendum::class);
    }
}
