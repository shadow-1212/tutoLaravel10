<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;
    //make all fields fillable excepts the id
    protected $guarded = ['id'];

    //cast created_at and updated_at dates to Carbon object
    protected $dates = ['created_at', 'updated_at'];
    //create a relationship between the post and the category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //create a relationship between the post and the tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


}
