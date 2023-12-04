<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostRequest;
use App\Models\Post;
use App\Models\PostContext;
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
		$post = Post::where('user_id', auth()->user()->id)->with(['postcontext', 'user'])->get();
		
		return response()->json($post);
	}
	
	public function allPosts()
	{
		$post = Post::with(['postcontext', 'user'])->get();
		
		return response()->json($post);
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
		Log::info('Custom log entry', ['key' => $request->file('image')]);
		
		$service->store($request);
		
		return response()->json([
			'success' => true,
			'post' => 'post successfully created'
		], 200);
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
	
	public function postShow($id)
	{
		$post = Post::where('id', $id)->with(['comments.user','comments.replies','user','postcontext'])->paginate(4);
		
		return response()->json($post);
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
		Post::where('id', $id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'post deleted successfully '
		], 200);
	}
	
	public function getPost($id)
	{
		$post = PostContext::where('post_id', $id)->get();
		
		return response()->json($post);
	}
	
}
