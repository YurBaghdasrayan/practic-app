<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BlockUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
	protected $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

	public function build(): BlockUserMail
	{
		return $this->markdown('emails.block-user')->subject('Block user')->with(['user' => $this->user]);
	}
}
