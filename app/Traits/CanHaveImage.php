<?php

namespace App\Traits;

trait CanHaveImage{
	public function image()
	{
		return $this->morphOne('App\Models\Image', 'imageable');
	}
}
