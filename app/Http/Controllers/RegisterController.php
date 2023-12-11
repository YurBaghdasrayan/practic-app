<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\VerifyMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
	/**
	 * @param RegisterRequest $request
	 * @return JsonResponse
	 */
	public function store(RegisterRequest $request): JsonResponse
	{
		$random = Str::random(40);
		
		$userData = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'role_id' => Role::USER_ID,
			'email_verify_token' => $random
		]);
		
		Mail::to($userData->email)->queue(new VerifyMail($random));
		
		return response()->json([
			'success' => true,
			'message' => 'user successfully registered'
		], 201);
	}
}
