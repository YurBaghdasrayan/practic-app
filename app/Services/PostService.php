<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Post;
use App\Models\PostContent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;


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
				$images = [];
				foreach ($request->file('images') as $image) {
					$destinationPath = 'public/uploads';
					$originalFile = time() . $image->getClientOriginalName();
					$image->storeAs($destinationPath, $originalFile);
					
					$images[] = [
						'image' => $originalFile,
						'post_id' => $post->id,
						'created_at' => Carbon::now(),
						'updated_at' => Carbon::now(),
					];
				}
				Image::insert($images);
			}
			DB::commit();
		} catch (QueryException $e) {
			DB::rollBack($e->getMessage());
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