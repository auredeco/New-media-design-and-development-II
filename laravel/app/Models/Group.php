<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Group extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a Group with Referendums
     */
    public function referendums()
    {
        return $this->hasMany(Referendum::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * Relates a Group with Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a Group with Posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("description", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
    public function getPaginatedUsers(){
        return $this->users()->paginate(10);
    }

}
