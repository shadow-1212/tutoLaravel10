<form action="" method="post">
    @csrf
    @method( $post->id ? 'PATCH': "POST")
    <label for="title">Title</label>
    <input type="text" name="title" value="{{old('title', $post->title)}}">
    @error('title') {{$message}} @enderror
    <label for="slug">Slug</label>
    <input type="text" name="slug" value="{{old('slug', $post->slug)}}">
    @error('slug') {{$message}} @enderror
    <label for="content">Content</label>
    <textarea type="text" name="content" >{{ old('content',$post->content) }}  </textarea>
    @error('content') {{$message}} @enderror
    <button type="submit">
        @if($post->id)
            Update
        @else
            Create
        @endif
    </button>
</form>
