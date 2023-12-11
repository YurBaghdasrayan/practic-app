<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function store(Request $request)
	{
		if ($request->filled('search')) {
			$users = User::search($request->search)->get();
		}
		return response()->json([
			'userssssss' => $users,
			'status' => true
		], 200);
	}
}
