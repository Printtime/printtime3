<?php

namespace App\Http\Controllers;

use App\Mail\OrderSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {
	public function send(Request $request) {
		//return $request->all();
		#return dd($request->user());

		$to = [
			'email' => 'zakaz@printtime.com.ua',
		];
		return Mail::to('dstaranenko@gmail.com')->send(new OrderSend());
		#return true;
	}
}
