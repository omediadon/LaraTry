<?php

namespace App\Lbc\Themes\Liara;

use App\Http\Controllers\Controller;
use App\Lbc\Themes\Liara\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller{
	public static function contact(){
		$data = [
			'meta' => [
				'title'  => 'Contact - Blog | Liara',
				'robots' => 'index, follow',
			],
		];

		return view('lbc.themes.liara.pages.contact.contact', compact('data'));
	}

	public function send(Request $request, Mailer $mailer){
		$rules = [
			'name'    => 'required',
			'email'   => 'required|email',
			'message' => 'required',
		];

		$messages = [
			'name.required'    => 'Please enter your name.',
			'email.required'   => 'Please enter your e-mail address.',
			'email.email'      => 'Please enter a correct e-mail address.',
			'message.required' => 'Please enter your message.',
		];

		$validator = Validator::make($request->all(), $rules, $messages);

		if($validator->fails()){
			return redirect(route('liara.contact'))
				->withErrors($validator)
				->withInput();
		}

		$mailer->to('info@zundel-webdesign.de')
		       ->send(new Contact($request->all()));

		return redirect(route('liara.contact'))->with('success', 'Your email was successfully sent.');
	}
}
