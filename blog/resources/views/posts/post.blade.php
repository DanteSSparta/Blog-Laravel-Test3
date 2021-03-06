<div class="blog-post">
            <h2 class="blog-post-title">
              <a href="/posts/{{$post->id}}">
                {{$post->title}}
              </a> 
            </h2>
            <p class="blog-post-meta">
              {{ $post->user->name}} on
              {{$post->created_at->toFormattedDateString()}}
            </p>

            <p>
              {!! $post->body !!}
            </p>
            @if(auth()->check())
            <div class="interaction">
            <a href="#" class="like">{{ auth()->user()->likes()->where('post_id' , $post->id)->first() ?
                auth()->user()->likes()->where('post_id' , $post->id)->first()->like == 1 ?
                "You like this post" : "Like" : "Like" }}</a> |
            <a href="#" class="like">{{ auth()->user()->likes()->where('post_id' , $post->id)->first() ?
                auth()->user()->likes()->where('post_id' , $post->id)->first()->like == 0 ?
                "You don\'t like this post" : "Dislike" : "Dislike" }}</a>
            </div>
            @endif


          </div><!-- /.blog-post -->

          
