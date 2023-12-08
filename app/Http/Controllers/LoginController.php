<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	/**
	 * @param LoginRequest $request
	 * @return Application|Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory
	 */
	public function store(LoginRequest $request)
	{
		$data = $request->except('_token');
		if (Auth::attempt($data)) {
			$token = auth()->user()->createToken('API Token')->accessToken;
			
			return response()->json([
				'user' => auth()->user(),
				'token' => $token
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'something was wrong'
			], 401);
		}
	}
}
