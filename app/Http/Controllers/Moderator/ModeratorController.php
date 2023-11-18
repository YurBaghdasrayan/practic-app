<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\ModeratorRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Services\ModeratorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ModeratorController extends Controller
{
	public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|Application
	{
		return view('moderator/home.index');
	}
	
	public function login(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|Application
	{
		return view('moderator/login');
	}
	
	public function usersPost(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|Application
	{
		$userPosts = Post::with(['comments', 'user'])->get();
		return view('moderator/home.user-posts', compact('userPosts'));
	}
	
	/**
	 * @param AdminLoginRequest $request
	 * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
	 */
	public function store(AdminLoginRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
	{
		$data = $request->except('_token');
		if (Auth::attempt($data)) {
			return redirect('moderator/home-moderator');
		} else {
			return redirect('moderator/login');
		}
	}
	
	/**
	 * @param string $id
	 * @return View|\Illuminate\Foundation\Application|Factory|Application
	 */
	public function usersComments(string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|Application
	{
		$comment = Comment::where('post_id', $id)->paginate(10);
		return view('moderator/home.user-comments', compact('comment'));
	}
	
	/**
	 * @param string $id
	 * @param ModeratorService $service
	 * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
	 */
	public function destroy(string $id, ModeratorService $service): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
	{
		$service->destroy($id);
		return redirect('moderator/users-posts');
	}
	
	/**
	 * @param string $id
	 * @return \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
	 */
	public function destroyComment(string $id, ModeratorService $service): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
	{
		$service->destroyComment(id: $id);
		return redirect('moderator/users-posts');
	}
	
	public function logout(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
	{
		\auth()->logout();
		return redirect('moderator/login');
	}
}
