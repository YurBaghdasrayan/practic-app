<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
	use HasFactory;
	
	protected $guarded = [];
	
	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	/**
	 * @return MorphMany
	 */
	public function comments(): MorphMany
	{
		return $this->morphMany(Comment::class, 'commentable');
	}
	
	/**
	 * @return HasOne
	 */
	public function postcontent(): HasOne
	{
		return $this->hasOne(PostContent::class);
	}
	
	/**
	 * @return HasMany
	 */
	public function images(): HasMany
	{
		return $this->hasMany(Image::class);
	}
}
