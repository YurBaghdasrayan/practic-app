<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $guarded = [];
	
	use HasFactory;
	
	public function commentable()
	{
		return $this->morphTo();
	}
	
	public function replies()
	{
		return $this->morphMany(ReplyComment::class, 'commentable');
	}
	
	
	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Post::class);
	}
}
