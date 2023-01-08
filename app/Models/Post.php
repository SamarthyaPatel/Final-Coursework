<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Many-to-One Relation
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    //One-to-Many Relation
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function board(){
        return $this->belongsTo(Board::class);
    }

    public function board(){
        return $this->belongsToMany(Tag::class);
    }
}
