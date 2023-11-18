<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
	/**
	 * @param $request
	 * @return void
	 */
	public function store($request): void
	{
		$image = $request->file('image');
		$destinationPath = 'public/uploads';
		$originalFile = time() . $image->getClientOriginalName();
		$image->storeAs($destinationPath, $originalFile);
		
		Post::create([
			'name' => $request->name,
			'description' => $request->description,
			'user_id' => auth()->user()->id,
			'image' => $originalFile
		]);
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