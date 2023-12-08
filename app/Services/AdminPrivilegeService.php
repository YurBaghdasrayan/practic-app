<?php

namespace App\Services;

use App\Mail\BlockUserMail;
use App\Mail\VerifyMail;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AdminPrivilegeService
{
	/**
	 * @param $id
	 * @return void
	 */
	public function destroy($id): void
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
	/**
	 * @param $id
	 * @return void
	 */
	public function blockUser($id): void
	{
		$user = User::find($id);
		
		Mail::to($user->email)->queue(new BlockUserMail($user));
		$user->delete();
	}
}