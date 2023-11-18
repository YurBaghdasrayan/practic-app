<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
	protected $softDelete = true;
	
	protected $guarded = [];
	
	public function role(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(Role::class);
	}
	
	public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(Post::class);
	}
	
	public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(Comment::class);
	}
}
