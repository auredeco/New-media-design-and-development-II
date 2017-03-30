<?php

namespace App;

use App\Models\{
    Post, Voter, Candidate
};
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a user with a voter
     */
    public function voter()
    {
        return $this->belongsTo(Voter::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relates a user with a candidate
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id');
    }
}
