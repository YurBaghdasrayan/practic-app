<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * @return JsonResponse
	 */
	public function getUsersData(): JsonResponse
	{
		$user = User::all();
		return response()->json(UserResource::collection($user));
	}
}
