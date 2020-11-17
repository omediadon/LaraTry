<?php

namespace App\Models;

use App\Contracts\Commentable;
use App\Contracts\Likeable;
use App\Traits\CanBeCommented;
use App\Traits\CanBeLiked;
use App\Traits\CanHaveImage;
use App\Traits\HasLocalDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 *
 * @package App\Models
 */
class Post extends Model implements Likeable, Commentable{
	use HasFactory, HasLocalDates, SoftDeletes, CanBeLiked, CanBeCommented, CanHaveImage;

	/**
	 * @var string[]
	 */
	protected $fillable
		= [
			'id',
			'user_id',
			'text',
			'type',
			'image',
			'category_id',
		];

	/**
	 * Dates that we want to reformat
	 *
	 * @var array $dates
	 */
	protected $dates
		= [
			'approved_at',
			'created_at',
			'updated_at',
		];


	/**
	 * @return BelongsTo
	 */
	public function user(){
		return $this->belongsTo(User::class);
	}

	/**
	 * @return BelongsTo
	 */
	public function category(){
		return $this->belongsTo(Category::class);
	}
}
