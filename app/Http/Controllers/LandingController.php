<?php

namespace App\Http\Controllers;

class LandingController extends Controller{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		$this->middleware('guest');
	}

	public function index(){
		$card = [
			'header' => [
				'headline' => [
					'class' => 'h6 mb-0',
					'link'  => [
						'class' => 'text-body',
						'text'  => 'Card Header Headline',
						'href'  => '#',
					],
				],
			],
			'image'  => [
				'src' => 'https://via.placeholder.com/253x169',
				'alt' => 'Card Image',
			],
			'body'   => [
				'text'     => 'Card Body Text',
				'headline' => [
					'class' => 'h5',
					'link'  => [
						'text' => 'Card Body Headline',
						'href' => '#',
					],
				],
			],
			'footer' => [
				'class' => '',
				'text'  => '<a href="#" class="btn btn-primary">Card Footer</a>',
				'link'  => [
					'text' => 'Card Footer',
					'href' => '#',
				],
			],
		];

		$data = compact('card');

		return view('welcome', $data);
	}
}
