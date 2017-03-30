<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relates a category with posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
