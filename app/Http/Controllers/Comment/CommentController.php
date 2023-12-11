<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;


class CommentController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(CommentRequest $request): JsonResponse
	{
		if ($request->file('file')) {
			$image = $request->file('file');
			$destinationPath = 'storage/uploads';
			$originalFile = time() . $image->getClientOriginalName();
			$image->storeAs($destinationPath, $originalFile);
		}
		$post = Post::find($request->post_id);
		$post->comments()->create([
			'comment' => $request->comment,
			'user_id' => auth()->user()->id,
			'file' => $originalFile ?? null,
		]);
		return response()->json([
			'success' => true,
			'message' => 'comment created successfully'
		], 200);
	}
	
	/**
	 * Display the specified resource.
	 */
	public function show(string $id): JsonResponse
	{
		$post = Comment::where('post_id', $id)->get();
		return response()->json($post);
	}
	
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id): JsonResponse
	{
		Comment::where('id', $id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'comment deleted successfully '
		], 200);
	}
}
