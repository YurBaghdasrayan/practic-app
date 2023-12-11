<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\VerifyMail;
use App\Models\Role;
use App\Models\User;
use App\Services\AdminPrivilegeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminPrivilegeController extends Controller
{
	
	/**
	 * @param $id
	 * @param AdminPrivilegeService $service
	 * @return JsonResponse
	 */
	public function blockUser($id, AdminPrivilegeService $service): JsonResponse
	{
		$service->blockUser($id);
		
		return response()->json([
			'success' => true,
			'message' => 'user successfully blocked'
		], 200);
	}
	
	/**
	 * @param RegisterRequest $request
	 * @return JsonResponse
	 */
	public function createModerator(RegisterRequest $request): JsonResponse
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
