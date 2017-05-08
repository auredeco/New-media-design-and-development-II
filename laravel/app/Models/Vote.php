<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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