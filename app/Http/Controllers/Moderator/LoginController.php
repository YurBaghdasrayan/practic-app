<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function store(LoginRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
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
