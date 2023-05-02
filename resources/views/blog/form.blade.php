<form action="" method="POST" class="form-control" enctype="multipart/form-data">
    @csrf
    <label for="title" class="label">Title</label>
    <input type="text" name="title" value="{{old('title', $post->title)}}" class="input input-bordered w-full max-w-xs">
    @error('title') {{$message}} @enderror
    <label for="title" class="label">Image</label>
    <input type="file" name="image"  class="file-input w-full max-w-xs">
    <label for="slug" class="label">Slug</label>
    <input type="text" name="slug" value="{{old('slug', $post->slug)}}" class="input input-bordered w-full max-w-xs">
    @error('slug') {{$message}} @enderror
    <label for="content">Content</label>
    <textarea type="text" name="content" class="textarea textarea-bordered textarea-lg w-full max-w-xs">{{ old('content',$post->content) }}  </textarea>
    @error('content') {{$message}} @enderror
    {{--    category--}}
    <label for="category_id" class="label" >Category</label>
    <select name="category_id" id="category_id" class="select select-bordered">
        <option selected value="" >--Select a category--</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}" @selected(old('category_id',$post->category_id) == $category->id)>{{$category->name}}</option>
        @endforeach
    </select>
    @error('category_id') {{$message}} @enderror
    {{--tags--}}
    @php
        $tagsIDS=$post->tags()->pluck('id');
    @endphp
    <label for="tags">Tags</label>
    <select name="tags[]" id="tags"  class="select select-bordered" multiple>
        <option disabled value="" >--Select tags--</option>
        @foreach($tags as $tag)
            <option  value="{{$tag->id}}" @selected($tagsIDS->contains($tag->id)) >{{$tag->name}}</option>
        @endforeach
    </select>
    @error('tags') {{$message}} @enderror

    <button type="submit" class="btn btn-success mt-3">
        @if($post->id)
            Update
        @else
            Create
        @endif
    </button>
</form>
