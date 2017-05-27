<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{


    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    



}
