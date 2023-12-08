<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
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
			
			return response(['user' => auth()->user(), 'token' => $token]);
			
		} else {
			return response()->json([
				'success' => false,
				'message' => 'something was wrong'
			], 401);
		}
	}
}
