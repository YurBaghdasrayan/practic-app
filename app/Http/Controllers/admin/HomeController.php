<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\HomeService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class HomeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	{
		$user = User::all();
		return view('admin.home.index');
	}
	
	/**
	 *
	 * Show the form for creating a new resource.
	 */
	public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	{
		$userRole = Role::whereIn('name', array('moderator', 'user'))->get();
		
		return view('admin.home.create', compact('userRole'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 * @param RegisterRequest $request
	 * @param HomeService $service
	 * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
	 */
	public function store(RegisterRequest $request, HomeService $service): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
	{
		$service->store($request);
		
		return redirect(route('home.index'));
	}
	
	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
