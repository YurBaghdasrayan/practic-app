<?php

namespace App\Http\Controllers\ReplyComment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
		$image = $request->file('file');
		$destinationPath = 'public/uploads';
		$originalFile = time() . $image->getClientOriginalName();
		$image->storeAs($destinationPath, $originalFile);
		
		ReplyComment::create([
			'reply' => $request->reply,
			'user_id' => auth()->user()->id,
			'comment_id' => $request->comment_id,
			'file' => $originalFile
		]);
		return response()->json([
			'success' => true,
			'message' => 'comment reply created successfully '
		], 200);
	}
}
