<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;
	
	protected $guarded = [];
	
	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(Comment::class);
	}
	
	public function postcontext(): \Illuminate\Database\Eloquent\Relations\HasOne
	{
		return $this->hasOne(PostContext::class);
	}
	
	public function images()
	{
		return $this->hasMany(Image::class);
	}
}
