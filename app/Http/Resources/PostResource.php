<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$return = parent::toArray($request);
		
		$return += [
			'replies' => PostResource::collection($this->whenLoaded('replies')),
			'user' => $this->resource->user,
			'postcontext' => $this->resource->postcontext,
			'comments' => $this->resource->comments,
		];
		return $return;
	}
}
