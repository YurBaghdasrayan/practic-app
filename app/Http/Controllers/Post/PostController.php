<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostRequest;
use App\Models\Post;
use App\Models\PostContext;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}
	
	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PostRequest $request, PostService $service)
	{
		$service->store($request);
		
		return response()->json([
			'success' => true,
			'message' => 'post successfully created'
		], 201);
	}
	
	/**
	 * Display the specified resource.
	 */
	public function show(string $id, $lang, PostService $service)
	{
		$postShow = PostContext::where('post_id', $id)->where('lang', $lang)->get();
		
		return response()->json([
			'success' => true,
			'post' => $postShow
		], 200);
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
	public function update(PostRequest $request, PostService $service, string $id)
	{
		$service->update($id, $request);
		return response()->json([
			'success' => true,
			'message' => 'post successfully updated'
		], 200);
	}
	
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
