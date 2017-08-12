<?php

namespace App\Http\Controllers;

use App\Http\Models\PostComments;
use App\Http\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if ( Auth::guest() ){
			$request->session()->flash('alert-danger', "You don't have permissions for Management page! Please, login first.");
			return redirect('/login');
		}

		$get_posts = Posts::all();

        return view('posts.list', [ 'posts' => $get_posts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    if ( Auth::guest() ){
		    return redirect('/');
	    }

	    $this->validate($request, [
		    'title' => 'required|max:255|min:1',
		    'desc' => 'required|min:1',
		    'image' => 'required'
	    ]);

	    $title = $request->title;
	    $desc = $request->desc;
	    $publish = $request->publish;

	    if ( $request->hasFile('image') ){
		    $image = $request->file('image');
		    $filename = md5($title) . rand(100,999) . '.' . $image->getClientOriginalExtension();
		    Image::make($image)->save( public_path('uploads/posts/' . $filename) );
	    }

	    $post = new Posts();
	    $post->title = $title;
	    $post->desc = $desc;

	    if ( $publish == 'on' ){
		    $post->publish = 1;
	    }else{
		    $post->publish = 0;
	    }

	    $post->image = $filename;
	    $post->author = Auth::id();

	    $post->save();

	    $request->session()->flash('alert-success', 'The post has been created!');
	    return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $get_post = Posts::where('id', $id)->first();
        $get_comments = PostComments::where('for_post', $get_post->id)->orderBy('id', 'desc')->get();

        return view('posts.show', [ 'post' => $get_post, 'comments' => $get_comments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    if ( Auth::guest() ){
		    return redirect('/');
	    }

	    $get_post = Posts::where('id', $id)->first();

	    return view('posts.edit', [ 'post' => $get_post ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    if ( Auth::guest() ){
		    return redirect('/');
	    }

	    $this->validate($request, [
		    'title' => 'required|max:255|min:1',
		    'desc' => 'required|min:1',
	    ]);

	    $title = $request->title;
	    $desc = $request->desc;
	    $publish = $request->publish;

	    if ( $request->hasFile('image') ){
	    	$image = $request->file('image');
	    	$filename = md5($title) . rand(100,999) . '.' . $image->getClientOriginalExtension();
	    	Image::make($image)->save( public_path('uploads/posts/' . $filename) );
	    }

	    $post = Posts::where('id', $id)->first();
	    $post->title = $title;
	    $post->desc = $desc;

	    if ( $publish == 'on' ){
		    $post->publish = 1;
	    }else{
		    $post->publish = 0;
	    }

	    if ( isset($filename) && !empty($filename) ){
	    	$post->image = $filename;
	    }

	    $post->save();


	    $request->session()->flash('alert-success', 'The post has been updated!');
	    return redirect('/posts/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $delete = Posts::where('id', $id)->delete();
	    $request->session()->flash('alert-success', 'The post has been deleted!');
	    return redirect('/posts/');
    }
}
