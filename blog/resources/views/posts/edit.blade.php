@extends('layouts.master')

@section('content')
    <div class="col-sm-8 blog-main">
        <h1>Edit a post</h1>

        <hr>

        <form method="post" action="{{route('posts.update', $post)}}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body">{{ $post->body }}</textarea >
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>
@endsection