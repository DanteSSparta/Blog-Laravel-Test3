<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
		$this->validate(Request(),['body' => 'required|min:2']);

		$post->addComment([
            'user_id' => auth()->id(),
            'post_id' => request('post_id'),
             'body'=> request('body')
        ]);

    	return back();
    }
}
