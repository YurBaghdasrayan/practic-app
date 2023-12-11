<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
	/**
	 * @return JsonResponse
	 */
	public function getUsersData(Request $request): JsonResponse
	{
		$string = $request->search;
		
		$array = explode(' ', $string);
		
		$array = array_filter($array);
		
		if ($request->filled('search')) {
			$user = User::search('admin  some')->get();
		} else {
			$user = User::all();
		}
		return response()->json(UserResource::collection($user));
	}
}
