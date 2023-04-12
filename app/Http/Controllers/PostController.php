<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //create a method to show all posts
    public function index()
    {
        //get all posts from the database and pass them to the view
        $posts = Post::paginate(15);
        return view('blog.index', ['posts' => $posts]);
    }
    //create a method to show a single post
    public function show(string $slug, string $id)
    {
        //get the post from the database and pass it to the view
        $post = Post::findOrFail($id);
        // test if the slug is correct
        if ($post->slug !== $slug) {
            //if not, redirect to the right route
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id], 301);
        }
        return view('blog.show', ['post' => $post]);
    }
}
