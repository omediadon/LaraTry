<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Renderable
	 */
	public function index(){

		$posts = Post::all()
		             ->reverse();

		$categories = Category::all()->collect()
		                      ->sortBy('name')->all();

		return view('home', compact('posts', 'categories'));
	}
}
