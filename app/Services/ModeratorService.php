<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;

class ModeratorService
{
	/**
	 * @param string $id
	 * @return void
	 */
	public function destroy(string $id): void
	{
		Post::where('id', $id)->delete();
	}
	
	/**
	 * @param $id
	 * @return void
	 */
	public function destroyComment($id): void
	{
		Comment::where('id', $id)->delete();
	}
}