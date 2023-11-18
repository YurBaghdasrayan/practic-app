<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
	use HasFactory;
	
	protected $guarded = [];
	
	public function comment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Comment::class);
	}
}
