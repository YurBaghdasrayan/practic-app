<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Image;
use App\Models\Post;
use App\Models\PostContent;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$post = Post::with(['postcontent', 'user'])->get();
		
		return response()->json($post);
	}
	
	public function allPosts()
	{
		$post = Post::where('user_id', auth()->user()->id)->with(['postcontent', 'user'])->get();
		
		return response()->json($post);
	}
	
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PostRequest $request, PostService $service)
	{
		$service->store($request);
		
		return response()->json([
			'success' => true,
			'post' => 'Post created successfully'
		], 201);
	}
	
	/**
	 * Display the specified resource.
	 */
	public function show(string $id, PostService $service)
	{
		$post = Post::where('id', $id)->with('comments.replies')->first();
		return response()->json(new PostResource($post));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$post = PostContent::where('post_id', $id)->get();
		
		return response()->json($post);
		
	}
	
	/**
	 * Update the specified resource in storage.
	 */
	public function update(PostRequest $request, PostService $service, string $id)
	{
		$service->update($id, $request);
		return response()->json([
			'success' => true,
			'message' => 'Post updated successfully'
		], 200);
	}
	
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Post::where('id', $id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Post deleted successfully '
		], 200);
	}
}
