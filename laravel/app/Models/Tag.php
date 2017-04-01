<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * Relates a Tag with Posts
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
}
