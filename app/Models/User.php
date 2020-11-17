<?php

namespace App\Models;

use App\Traits\CanComment;
use App\Traits\CanHaveImage;
use App\Traits\HasLocalDates;
use App\Traits\CanLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
	use HasFactory, Notifiable, HasLocalDates, SoftDeletes, CanLike, CanComment, CanHaveImage;

	/**
	 * Dates that we want to reformat
	 *
	 * @var string[] $dates
	 */
	protected $dates = ['approved_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable
		= [
			'name',
			'email',
			'timezone',
			'password',
			'is_admin',
		];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden
		= [
			'password',
			'remember_token',
		];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts
		= [
			'email_verified_at' => 'datetime',
		];

	public function posts(){
		return $this->hasMany(Post::class);
	}
}
