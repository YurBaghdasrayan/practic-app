<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	/**
	 * @param LoginRequest $request
	 * @return Application|ResponseFactory|\Illuminate\Foundation\Application|JsonResponse|Response
	 */
	public function store(LoginRequest $request)
	{
		$data = $request->except('_token');
		if (Auth::attempt($data)) {
			$token = auth()->user()->createToken('API Token')->accessToken;
			
			return response(['user' => auth()->user(), 'token' => $token]);
			
		} else {
			return response()->json([
				'success' => false,
				'message' => 'something was wrong'
			], 401);
		}
	}
}
