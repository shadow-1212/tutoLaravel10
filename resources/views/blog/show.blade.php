{{--show an article with title and content--}}
<div>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
    <a href="{{route('blog.index')}}">Retour au blogs</a>

</div>
