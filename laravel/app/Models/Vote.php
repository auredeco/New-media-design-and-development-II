<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a Vote with a Referendum
     */
    public function referendum()
    {
        return $this->belongsTo(Referendum::class);
    }
}
