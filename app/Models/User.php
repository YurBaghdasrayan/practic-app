<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Searchable;
	
	protected bool $softDelete = true;
	
	protected $guarded = [];
	
	public function role(): Relations\HasMany
	{
		return $this->hasMany(Role::class);
	}
	
	public function posts(): Relations\HasMany
	{
		return $this->hasMany(Post::class);
	}
	
	public function comments(): Relations\HasMany
	{
		return $this->hasMany(Comment::class);
	}
	
	
	public function toSearchableArray(): array
	{
		return [
			'name' => $this->name,
			'email' => $this->email
		];
	}
}
