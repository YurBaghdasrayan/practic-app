<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	/**
	 * @param CommentRequest $request
	 * @return JsonResponse
	 */
	public function store(CommentRequest $request): \Illuminate\Http\JsonResponse
	{
		$image = $request->file('file');
		$destinationPath = 'public/uploads';
		$originalFile = time() . $image->getClientOriginalName();
		$image->storeAs($destinationPath, $originalFile);
		
		Comment::create([
			'comment' => $request->comment,
			'user_id' => auth()->user()->id,
			'post_id' => $request->post_id,
			'file' => $originalFile
		]);
		return response()->json([
			'success' => true,
			'message' => 'comment created successfully '
		], 200);
	}
}
