<?php

namespace App\Models;

use App\Traits\CanHaveImage;
use App\Traits\HasLocalDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model{
	use HasFactory, SoftDeletes, HasLocalDates, CanHaveImage;

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

	public function posts(){
		return $this->hasMany(Post::class);
	}
}
