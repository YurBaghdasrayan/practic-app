<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class PostContent extends Model
{
	use HasFactory;
	protected $guarded = [];
	
	protected $table = 'post_context';
	
	
	public function post(): Relations\BelongsTo
	{
		return $this->belongsTo(Post::class);
	}
	
}
