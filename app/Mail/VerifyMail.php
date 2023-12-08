<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;
	
	private $token;
	
	/**
     * Create a new message instance.
     */
    public function __construct($token)
    {
	    $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
	public function build()
	{
		return $this->markdown('emails.verify')->subject('Verify email')->with(['token' => $this->token]);
	}
}
