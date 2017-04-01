<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
