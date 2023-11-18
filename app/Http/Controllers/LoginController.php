<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	/**
	 * @param AdminLoginRequest $request
	 * @return Application|Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory
	 */
	public function store(AdminLoginRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
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
	
	public function logout()
	{
		\auth()->logout();
		return redirect('/login');
	}
	
}
