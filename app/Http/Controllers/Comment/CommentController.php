<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\ReplyComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
	public function index($id)
	{
		$post = Comment::where('post_id', $id)->get();
		return response()->json($post);
	}
	
	/**
	 * @param CommentRequest $request
	 * @return JsonResponse
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
			'file' => $originalFile??null,
		]);
		return response()->json([
			'success' => true,
			'message' => 'comment created successfully'
		], 200);
	}
	
	public function delete($id)
	{
		Comment::where('id', $id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'comment deleted successfully '
		], 200);
	}
	
	public function commentReplyDelete($id)
	{
		ReplyComment::where('id', $id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'comment deleted successfully '
		], 200);
		
	}
}
