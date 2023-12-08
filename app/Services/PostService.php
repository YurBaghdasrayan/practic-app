<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Post;
use App\Models\PostContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
			
			$post = Post::create([
				'user_id' => auth()->user()->id,
			]);
			
			PostContent::create([
				'name' => $request->name,
				'description' => $request->description,
				'post_id' => $post->id,
				'lang' => 'eng'
			]);
			if ($request->hasFile('images')) {
				foreach ($request->file('images') as $image) {
					$destinationPath = 'public/uploads';
					$originalFile = time() . $image->getClientOriginalName();
					$image->storeAs($destinationPath, $originalFile);
					
					Image::create([
						'image' => $originalFile,
						'post_id' => $post->id,
					]);
				}
			}
			DB::commit();
		} catch (error) {
			DB::rollBack();
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
		$postShow = PostContent::find($id);
		
		$newDara = array_filter($data, function ($data) {
			return $data !== null;
		});
		
		$postShow->update([
			'name' => $newDara['name'],
			'description' => $newDara['description'],
		]);
		
		if ($request->file('image')) {
			$image = $request->file('image');
			$destinationPath = 'public/uploads';
			$originalFile = time() . $image->getClientOriginalName();
			$image->storeAs($destinationPath, $originalFile);
			$image = Image::create([
				'image' => $originalFile,
				'post_id' => $postShow->post_id
			]);
		}
	}
}