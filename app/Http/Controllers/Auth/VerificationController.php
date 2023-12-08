<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
	use VerifiesEmails;
	
	/**
	 * @param $token
	 * @return void
	 */
	public function verify($token): void
	{
		$user = User::where('email_verify_token', $token)->update(['email_verified_at' => Carbon::now()]);
	}
}
