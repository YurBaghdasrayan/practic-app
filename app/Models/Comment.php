<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
	protected $guarded = [];
	
	use HasFactory;
	
	/**
	 * @return MorphTo
	 */
	public function commentable(): MorphTo
	{
		return $this->morphTo();
	}
	
	/**
	 * @return MorphMany
	 */
	public function replies(): MorphMany
	{
		return $this->morphMany(self::class, 'commentable');
	}
	
	
	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	/**
	 * @return BelongsTo
	 */
	public function post(): BelongsTo
	{
		return $this->belongsTo(Post::class);
	}
}
