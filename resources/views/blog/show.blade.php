{{--show an article with title and content--}}
@extends('base')
@section('title', $post->title)
@section('content')
    <div class="card card-side bg-base-100 shadow-xl w-full h-[700px]">
        <figure><img src="{{$post->imageUrl()}}" alt="Movie" class=""/></figure>
        <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <div class="flex gap-3">
                @foreach($post->tags as $tag)
                    <div class="badge badge-outline badge-primary">{{$tag->name}}</div>
                @endforeach
            </div>
            <div>Category: <span class="font-bold">{{$post->category->name}}</span> </div>
            <p>{{$post->content}}</p>
            @include('blog.contact-form', ['post' => $post])
       </div>
    </div>
@endsection
