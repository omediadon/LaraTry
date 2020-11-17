<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanBeLiked{
	public function likes(): MorphMany{
		return $this->morphMany(Like::class, 'likeable');
	}

	public function likers(): HasManyThrough{
		return $this->hasManyThrough(Like::class, User::class);
	}
}
