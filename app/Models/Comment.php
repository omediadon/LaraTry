<?php

namespace App\Models;

use App\Traits\CanBeLiked;
use App\Traits\CanHaveImage;
use App\Traits\HasLocalDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model{
	use HasFactory, HasLocalDates, SoftDeletes, CanBeLiked, CanHaveImage;

	/**
	 * @var string[]
	 */
	protected $fillable
		= [
			'id',
			'user_id',
			'text',
			'post_id',
		];
	/**
	 * Dates that we want to reformat
	 *
	 * @var string[] $dates
	 */
	protected $dates
		= [
			'approved_at',
			'created_at',
			'updated_at',
		];


	public function user(){
		return $this->belongsTo(User::class)
		            ->withDefault();
	}

	public function commentable(){
		return $this->morphTo();
	}

}
