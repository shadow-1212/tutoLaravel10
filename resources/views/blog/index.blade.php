{{--render a list of blod using the blogs variable--}}
@extends('base')
@section('title', 'Home')
@section('content')
    <div class="w-full">
        <a href="{{route('blog.create')}}" class="btn btn-info my-2">Create new post</a>
        @foreach($posts as $post)
            <article class="my-6w-full">
                @if($post->image)
                    <div class="h-[200px] w-full">
                        <img src="{{$post->imageUrl()}}" alt="" class="w-full h-full object-cover">
                    </div>
                @endif
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
                <div class="pt-4 flex gap-3">
                    <a href="{{route('blog.show',['slug'=>$post->slug, 'post'=>$post->id])}}" class="btn btn-outline btn-info">Read more</a>
                    <a href="{{route('blog.edit',['post'=>$post->id])}}" class="btn btn-outline btn-success">Edit</a>
                    @can('delete',$post)
                        <form action="{{route('blog.destroy',$post)}}" method="post" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-error">Delete</button>
                        </form>
                    @endcan
                </div>

            </article>
        @endforeach
        {{$posts->links()}}
    </div>
@endsection
