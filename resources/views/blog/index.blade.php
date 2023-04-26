{{--render a list of blod using the blogs variable--}}
<div>
    <a href="{{route('blog.create')}}">Create new post</a>
    @foreach($posts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p>{{ $post?->category?->name }}</p>
            <a href="{{route('blog.show',['slug'=>$post->slug, 'post'=>$post->id])}}">Read more</a>
            <a href="{{route('blog.edit',['post'=>$post->id])}}">Edit</a>
        </div>
    @endforeach
    {{$posts->links()}}
</div>
