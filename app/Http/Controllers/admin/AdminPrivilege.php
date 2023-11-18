<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Services\AdminPrivilegeService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;

class AdminPrivilege extends Controller
{
	public function usersPost(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	{
		$userPosts = Post::with(['comments', 'user'])->paginate(10);
		return view('admin/home.user-posts', compact('userPosts'));
	}
	
	/**
	 * @param $id
	 * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function usersComments($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	{
		$comment = Comment::where('post_id', $id)->paginate(10);
		return view('admin/home.user-comments', compact('comment'));
	}
	
	/**
	 * @param $id
	 * @param AdminPrivilegeService $service
	 * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
	 */
	public function destroy($id, AdminPrivilegeService $service): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
	{
		$service->destroy($id);
		return redirect('admin/users-posts');
	}
	
	/**
	 * @param $id
	 * @param AdminPrivilegeService $service
	 * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
	 */
	public function destroyComment($id, AdminPrivilegeService $service): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
	{
		$service->destroyComment($id);
		return redirect('admin/users-posts');
	}
	
	public function usersList(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
	{
		$users = User::paginate(10);
		return view('admin/home.users-list', compact('users'));
	}
	
	/**
	 * @param $id
	 * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
	 */
	public function blockUser($id,AdminPrivilegeService $service): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
	{
		$service->blockUser($id);
		return redirect('admin/home');
	}
	
}
