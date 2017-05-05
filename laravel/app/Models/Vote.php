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

    /**
     * @var bool
     * to prevent connection with user
     */
    public $timestamps = false;

    /**
     * @var array
     * allow everything
     */
    protected $guarded = [];
}