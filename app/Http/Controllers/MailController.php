<?php

namespace App\Http\Controllers;

use App\Mail\OrderSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {
	public function send(Request $request) {
		$data = $request->all();
		return Mail::to(env('MAIL_USERNAME'), env('MAIL_NAME'))->send(new OrderSend($data));
	}
}
