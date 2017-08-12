<?php

namespace App\Http\Controllers;

use App\Http\Models\PostComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
	public function store(Request $request)
	{
		if ( Auth::guest() ){
			return;
		}

		if ( $request->data != null && $request->post != null ){
			$comment_author = Auth::id();
			$comment_data = $request->data;
			$comment_post = $request->post;

			$comment = new PostComments();
			$comment->desc = $comment_data;
			$comment->author = $comment_author;
			$comment->for_post = $comment_post;
			$comment->save();
		}

		return 'success';
	}
}
