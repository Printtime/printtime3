<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSend extends Mailable implements ShouldQueue {
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		//office@printtime.com.ua
		$from = ['address' => 'dstaranenko@gmail.com', 'name' => 'Printtime'];
		return $this->from($from)->view('emails.orders.send');
		#return $this->view('view.name');
	}
}
