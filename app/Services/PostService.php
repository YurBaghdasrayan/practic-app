<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Post;
use App\Models\PostContext;
use Illuminate\Support\Facades\DB;

class PostService
{
	/**
	 * @param $request
	 * @return void
	 */
	public function store($request): void
	{
		
		try {
			DB::beginTransaction();
			
			$image = $request->file('image');
			$destinationPath = 'public/uploads';
			$originalFile = time() . $image->getClientOriginalName();
			$image->storeAs($destinationPath, $originalFile);
			
			Post::create([
				'user_id' => auth()->user()->id,
			]);
			PostContext::create([
				'name' => $request->name,
				'description' => $request->description,
				'post_id' => $request->post_id,
				'lang' => $request->lang
			]);
			Image::create([
				'image' => $originalFile,
				'post_id' => $request->post_id
			]);
			
			DB::rollBack();
		} catch (error) {
			
			DB::commit();
		}
	}
	
	/**
	 * @param $id
	 * @param $request
	 * @return void
	 */
	public function update($id, $request): void
	{
		$data = $request->all();
		$postShow = Post::find($id);
		
		$newDara = array_filter($data, function ($data) {
			return $data !== null;
		});
		
		$image = $request->file('image');
		$destinationPath = 'public/uploads';
		$originalFile = time() . $image->getClientOriginalName();
		$image->storeAs($destinationPath, $originalFile);
		
		$postShow->update([
			'name' => $newDara['name'],
			'description' => $newDara['description'],
			'image' => $originalFile,
		]);
	}
}