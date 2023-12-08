<?php

namespace App\Http\Controllers\ReplyComment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class ReplyCommentController extends Controller
{
	public function store(Request $request)
	{
		$image = $request->file('file');
		$originalFile = null;
		if ($image) {
			$destinationPath = 'public/uploads';
			$originalFile = time() . $image->getClientOriginalName();
			$image->storeAs($destinationPath, $originalFile);
		}
		
		$comment = Comment::find($request->comment_id);
		$comment->replies()->create([
			'comment' => $request->reply,
			'user_id' => auth()->user()->id,
			'file' => $originalFile,
		]);
		return response()->json([
			'success' => true,
			'message' => 'comment reply created successfully '
		], 200);
	}
}
