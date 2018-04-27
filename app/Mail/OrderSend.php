<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSend extends Mailable implements ShouldQueue {
	use Queueable, SerializesModels;

	protected $data;
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($data) {
		$this->data = $data;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {

		$from = ['address' => env('MAIL_USERNAME'), 'name' => env('MAIL_NAME')];
		return $this->from(env('MAIL_USERNAME'), env('MAIL_NAME'))->subject('Запрос с сайта')->view('emails.orders.send')
			->with([
				'data' => $this->data,
			]);
	}
}
