<?php

namespace App;

use App\Models\{
    Post, Voter, Candidate, Group
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a user with posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * Relates a User with Groups
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_users');
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("firstname", "LIKE","%$keyword%")
                    ->orWhere("lastname", "LIKE", "%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("gender", "=", "$keyword")
                    ->orWhere("username", "LIKE", "%$keyword%")
                    ->orWhere("birthdate", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
