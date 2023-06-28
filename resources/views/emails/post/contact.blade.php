<x-mail::message>
# New contact request

A new contact request has been submitted for the post <a href="{{route('blog.show',['slug'=> $post->slug,'post'=> $post])}}">{{ $post->title }}</a>
- Name: {{ $data['name'] }}
- email: {{ $data['email'] }}

**Message:**<br/>
    {{ $data['message'] }}
</x-mail::message>
