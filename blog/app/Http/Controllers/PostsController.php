<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use App\Repositories\Posts;
use App\WordsFilter;

class PostsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except(['index','show']);
    }

    public function index(\App\Tag $tag=null)
   	{	

      
      //$posts = $posts->all();
   		$posts = Post::latest()
        ->filter([
          'month'=>request('month'),
          'year'=>request('year')
        ])
        ->get();

      //Temporary
      if(count($posts)>0) {
            $posts = $this->textFilter($posts);
        }

   		return view('posts.index',compact('posts'));
   	}
 	  public function show(Post $post)
   	{	
      $post = $this->textFilter($post);
   		return view('posts.show',compact('post'));
   	}
   	public function create()
   	{	
   		return view('posts.create');
   	}

   	public function store()
   	{	
   		$this->validate(request(),[
   			'title'=>'required',
   			'body'=> 'required'
   		]);
   	
      if(request()->hasFile('file')){
        $image = request()->file('file');
        $image->move(public_path().'/photos/', $image->getClientOriginalName());
        $path = $image->getClientOriginalName();
        }
        else $path="";
        auth()->user()->publish(
            new Post([
                'title' => request('title'),
                'body' => request('body'),
                'img_url' => $path
            ])
        );


      session()->flash('message','Your post has now been published');
   		
   		return redirect('/');
   	}

    public function edit(Post $post)
    {
        return view('posts.edit' , compact('post'));
    }

    public function update(Post $post)
    {
        $post->update([
           'title' => request('title'),
           'body' => request('body')
        ]);

        session()->flash(
            'message', 'Post was edited.'
        );

        return redirect()->home();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash(
            'message', 'Post was deleted.'
        );

        return redirect()->home();
    }

    public function likePost()
    {
        $post_id = request('postId');
        $is_like = request('isLike')==='true';
        $update = false;
        $post = Post::find($post_id);
        if(!$post){
            return null;
        }
        $user = auth()->user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if($like){
            $already_like = $like->like;
            $update = true;
            if($already_like == $is_like){
                 $like->delete();
                 return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;

        if($update){
            $like->update();
        } else{
            $like->save();
        }
        return null;
    }

    public function textFilter($posts)
    {
        $wordsArray = WordsFilter::all();
        if (count($wordsArray) == 0) {
            return $posts;
        }
        if (count($posts)>1) {
                foreach ($posts as $post) {
                    $post = $this->replaceWord($post, $wordsArray);
                }
            return $posts;
        }
        else
        {

            if(get_class($posts)==Post::class) {
                $posts = $this->replaceWord($posts, $wordsArray);
            }
            else {
                $posts[0] = $this->replaceWord($posts[0], $wordsArray);
            }
        }

        return $posts;
    }

    public function replaceWord($post , $wordsArray)
    {
        foreach ($wordsArray as $word)
        {
            $new_word_array [] = $word->word;
            $length = mb_strlen($word->word);
            $replace = str_repeat('*',$length-2);
            $new_word =  iconv('UTF-8', 'UTF-8//IGNORE', substr_replace($word->word , $replace , 2, -2));
            $new_changed_word_array[] = $new_word;
        }
        $post->body = str_replace($new_word_array, $new_changed_word_array, $post->body);
        $post->title = str_replace($new_word_array, $new_changed_word_array, $post->title);
        return $post;
    }
}
