<?php

namespace App\Http\Controllers;

use App\Events\ContactRequestEvent;
use App\Http\Requests\ContactPostRequest;
use App\Http\Requests\PostRequest;
use App\Mail\PostContactMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    //create a method to show all posts
    public function index(): View
    {
        //get all posts from the database and pass them to the view
        $posts = Post::with('tags','category')->paginate(15);
        return view('blog.index', ['posts' => $posts]);
    }

    //create a method to show a single post
    public function show(string $slug, Post $post): View
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
        //create a new post
        $post = Post::create($this->extractData(new Post(), $request));
        $post->tags()->sync($request->validated('tags'));
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
        dd($this->authorize('update', $post));
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

        //update the post
        $post->update($this->extractData($post, $request));
        $post->tags()->sync($request->validated('tags'));
        //redirect to the show view
        return to_route('blog.show', ['slug' => $post->slug, 'post' => $post->id], 301)->with('success', 'Post updated successfully');
    }

    //extract image for post
    private function extractData(Post $post, PostRequest $request):array
    {
        //validate the request
        $validated = $request->validated();
        /**
         * @var UploadedFile|null $image
         */
        $image=$request->validated('image');
        if($image === null || $image->getError()){
            return $validated;
        }
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $validated['image'] = $image->store('blog', 'public');
        return $validated;
    }

    public function destroy(Post $post)
    {
        //delete image
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return to_route('blog.index')->with('success', 'Post deleted successfully');
    }

    //contact method to contact the post publisher
    public function contact(Post $post, ContactPostRequest $request)
    {
        event(new ContactRequestEvent($post, $request->validated()));
        //send mail to the web app owner
        //return back with success message
        return back()->with('success_mail', 'Message sent successfully');
    }
}
