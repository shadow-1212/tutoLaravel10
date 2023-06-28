@extends('base')
@section('title', "Edit {$post->title}")
@section('content')
<div>
    <h1 class="text-2xl font-bold" >Editer l'article</h1>
    @include('blog.form')
</div>
@endsection
