<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse|Response|object
	 */
	public function store(Request $request){
		$ret   = [
			'message' => __('post.created_success'),
			'code'    => 200,
		];
		$input = $request->all();


		$post = new Post([
			                 "text"        => $input["post"],
			                 "category_id" => $input["category"],
		                 ]);
		try{
			// create or update some data
			if(!Auth::user()
			        ->posts()
			        ->save($post)){
				$ret["message"] = __('post.created_fail');
				$ret["code"]    = 400;
			}
		}
		catch(Exception $e){
			$ret["message"] = __('post.created_fail');
			$ret["code"]    = 400;
		}

		return response()
			->json($ret)
			->setStatusCode($ret["code"]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Post $post
	 *
	 * @return Response
	 */
	public function show(Post $post){
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Post $post
	 *
	 * @return Response
	 */
	public function edit(Post $post){
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Post    $post
	 *
	 * @return JsonResponse|Response|object
	 */
	public function update(Request $request, Post $post){
		$ret = [
			'message' => __('post.created_success'),
			'code'    => 200,
		];

		$user = Auth::user();
		assert($user instanceof User);

		if($request->input('like')){
			$like = $request->input('like');
			if($like == "+"){
				//$post->like += 1;
				$user->addLike($post);
			}
			else if($like == '-'){
				//$post->like -= 1;
				$user->removeLike($post);
			}
			else{
				goto error;
			}
			$ret["likes"] = $post->likes()
			                     ->count();
			goto returns;
		}
		else{
			$messages  = [
				'text.required' => __('post.error_text_required'),
				'text.min'      => __('post.error_text_min', ['i' => '50']),
			];
			$rules     = [
				'text' => 'required|min:50',
			];
			$validator = Validator::make($request->all(), $rules, $messages);

			if($validator->fails()){
				$errors = $validator->errors();
				goto error;
			}
			else{
				$post->text = $request->input('text');
				goto save;
			}
		}

		save:
		try{
			if(!Auth::user()
			        ->posts()
			        ->save($post)){
				goto error;
			}
			else{
				goto returns;
			}
		}
		catch(Exception $e){
			goto error;
		}

		error:
		$ret["message"] = __('post.created_fail');
		$ret["code"]    = 400;
		if(isset($errors) && !is_null($errors)){
			$ret["message"] = $errors->messages();
		}
		goto returns;

		returns:

		return response()
			->json($ret)
			->setStatusCode($ret["code"]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Post $post
	 *
	 * @return Response
	 */
	public function destroy(Post $post){
		//
	}


}
