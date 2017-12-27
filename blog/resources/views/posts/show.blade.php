@extends('layouts.master')

@section('content')
	<div class="col-sm-8 blog-main">

		<div class="blog-post">
            <h1 class="blog-post-title">
                {{$post->title}}
            </h1>
            <p class="blog-post-meta">
              {{$post->created_at->toFormattedDateString()}}
            </p>

            @if(count($post->tags))
                <ul>
                    @foreach ($post->tags as $tag)
                        <li>
                            <a href="/posts/tags/{{$tag->name}}">
                            {{$tag->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <img src="/photos/{{ $post->img_url }}" alt="" style="width: 100%; 
            {{$post->body}}

            @if($post->user_id==auth()->id())
            <form method="post" action="{{route('posts.destroy', $post)}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            <div class="form-group">
                <button type="submit" class="btn btn-primary" >Delete</button>
            </div>
            </form>
                <div class="form-group">
                <button type="submit" class="btn btn-primary" ><a href="/posts/{{$post->id}}/edit">Edit </a></button>
            </div>
            @endif

          	<hr>

            <div class="comments">
            	<ul class="list-group"> 
            	@foreach ($post->comments as $comment)
            		<li class="list-group-item">
            			<strong>
            				{{$comment->created_at->diffForHumans() }} : &nbsp;
            			</strong>
            			{{ $comment->body}}
            		</li>
            	@endforeach
            	</ul>
            </div>

            <hr>

            <div class="card">
            	<div class="card-block">
            		<form method="POST" action="/posts/{{$post->id}}/comments/">
            			{{csrf_field()}}
                        <input type="hidden" name="user_id" value="{{$post->user_id}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
	            		<div class="form-group">
							<textarea name="body" placeholder="Your comment here." class="form-control"></textarea>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Add Comment</button>
						</div>	
					</form>
            	</div>
            </div>

            @include ('layouts.errors')
          </div><!-- /.blog-post -->
	</div>
@endsection