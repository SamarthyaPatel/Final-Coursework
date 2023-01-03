<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //Many-to-One Relation
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //Many-to-One Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
