<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomeService
{
	/**
	 * @param $request
	 * @return void
	 */
	public function store($request): void
	{
		$random = Str::random(40);
		
		$data = $request->except('_token');
		$userData = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'role_id' => $data['role_id'],
			'email_verify_token'=>$random
		]);
	}
}
