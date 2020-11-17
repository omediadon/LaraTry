<?php

namespace App\Traits;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanBeCommented{
	public function comments(): MorphMany{
		return $this->morphMany(Comment::class, 'commentable');
	}

	public function commenters(): HasManyThrough{
		return $this->hasManyThrough(Comment::class, User::class);
	}
}
