<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Jobs\RegisterSuccessfullyJob;
use App\Mail\VerifyMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
	/**
	 * @param RegisterRequest $request
	 * @return JsonResponse
	 */
	public function store(RegisterRequest $request): \Illuminate\Http\JsonResponse
	{
		$random = Str::random(40);
		
		$userData = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password,
			'role_id' => $request->role_id,
			'email_verify_token'=>$random
		]);
		Mail::to($userData->email)->queue(new VerifyMail($random));
		
		if ($userData) {
			return response()->json([
				'success' => true,
				'message' => 'user successfully registered'
			]);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'something was wrong'
			]);
		}
	}
}
