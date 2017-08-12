<?php

namespace App\Http\Controllers;

use App\Http\Models\Posts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$get_posts = Posts::where('publish', 1)->get();

        return view('home', ['posts' => $get_posts]);
    }
}
