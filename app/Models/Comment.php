<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	
	protected $guarded = [];
	
	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Post::class);
	}
	
	public function commentreply(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(ReplyComment::class);
	}
	
}
