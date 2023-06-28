<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    //relation between the tag and the post
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
