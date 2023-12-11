<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Role extends Model
{
	use HasFactory;
	
	protected $guarded = [];
	const MODERATOR_ID = 3;
	const ADMIN_ID = 2;
	const USER_ID = 1;
	
	public function user(): Relations\HasMany
	{
		return $this->hasMany(User::class);
	}
	
}
