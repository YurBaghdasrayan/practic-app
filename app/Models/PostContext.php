<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostContext extends Model
{
	use HasFactory;
	protected $guarded = [];
	
	protected $table = 'post_context';
	
	
	public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Post::class);
	}
	
}
