<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
	public function store(LoginRequest $request): Application|Response|JsonResponse
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
