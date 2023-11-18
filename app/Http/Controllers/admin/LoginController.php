<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	{
		return view('admin/login');
	}
	
	/**
	 * @param AdminLoginRequest $request
	 * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
	 */
	public function store(AdminLoginRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
	{
		$data = $request->except('_token');
		
		if (Auth::attempt($data)) {
			return redirect(route('home.index'));
		} else {
			return redirect('admin/login');
		}
	}
	
	public function logout(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
	{
		\auth()->logout();
		return redirect('admin/login');
	}
}
