<?php

namespace App\Http\Controllers\ReplyComment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\ReplyComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReplyCommentController extends Controller
{
	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function store(Request $request): \Illuminate\Http\JsonResponse
	{
		if ($request->file('file')) {
			$image = $request->file('file');
			$destinationPath = 'public/uploads';
			$originalFile = time() . $image->getClientOriginalName();
			$image->storeAs($destinationPath, $originalFile);
			
			$comment = Comment::find($request->comment_id);
			$comment->replies()->create([
				'reply' => $request->reply,
				'user_id' => auth()->user()->id,
				'file' => $originalFile,
			]);
			
		} else {
			$comment = Comment::find($request->comment_id);
			
			$comment->replies()->create([
				'reply' => $request->reply,
				'user_id' => auth()->user()->id,
			]);
			return response()->json([
				'success' => true,
				'message' => 'comment reply created successfully '
			], 200);
			
		}
	}
}
