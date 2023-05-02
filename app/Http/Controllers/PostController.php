<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //create a method to show all posts
    public function index()
    {
        //get all posts from the database and pass them to the view
        $posts = Post::with('tags','category')->paginate(15);
        return view('blog.index', ['posts' => $posts]);
    }

    //create a method to show a single post
    public function show(string $slug, Post $post)
    {
        //get the post from the database and pass it to the view
        return view('blog.show', ['slug'=> $slug, 'post' => $post]);
    }

    //create a method to show the form to create a post
    public function create()
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
            ]);
    }

    //create a method to save a new post
    public function store(PostRequest $request)
    {
        //validate the request
        $validated = $request->validated();
        //create a new post
        $post = Post::create($validated);
        $post->tags()->sync($validated['tags']);
        //redirect to the show view
        return to_route('blog.show', ['slug' => $post->slug, 'post' => $post->id], 301)->with('success', 'Post created successfully');
    }
    /*{
        //get the post from the database and pass it to the view
        $post = Post::findOrFail($id);
        // test if the slug is correct
        if ($post->slug !== $slug) {
            //if not, redirect to the right route
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id], 301);
        }
        return view('blog.show', ['post' => $post]);
    }
    */
    //create a method to show the form to edit a post
    public function edit(Post $post)
    {
        //get the post from the database and pass it to the view
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    //create a method to update a post
    public function update(PostRequest $request, Post $post)
    {
        //validate the request
        $validated = $request->validated();
        //update the post
        $post->update($validated);
        $post->tags()->sync($validated['tags']);
        //redirect to the show view
        return to_route('blog.show', ['slug' => $post->slug, 'post' => $post->id], 301)->with('success', 'Post updated successfully');
    }


}
