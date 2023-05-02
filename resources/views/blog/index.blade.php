{{--render a list of blod using the blogs variable--}}
@extends('base')
@section('title', 'Home')
@section('content')
    <div>
        <a href="{{route('blog.create')}}" class="btn btn-info my-2">Create new post</a>
        @foreach($posts as $post)
            <div class="my-6">
                <h1 class="text-2xl" >{{ $post->title }}</h1>
                @if($post->category)
                    <p> catégorie: <span class="font-bold" >{{ $post->category?->name }}</span> </p>
                @endif
                @if(!$post->tags->isEmpty())
                    <p>Tags:
                        @foreach($post->tags as $tag)
                            <span class="badge">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </p>
                @endif
                <p>{{ $post->content }}</p>
                <div class="pt-4">
                    <a href="{{route('blog.show',['slug'=>$post->slug, 'post'=>$post->id])}}" class="btn btn-outline btn-info">Read more</a>
                    <a href="{{route('blog.edit',['post'=>$post->id])}}" class="btn btn-outline btn-success">Edit</a>
                </div>

            </div>
        @endforeach
        {{$posts->links()}}
    </div>
@endsection
