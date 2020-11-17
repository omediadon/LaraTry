<?php

namespace App\Http\View;

class NavigationViewComposer{
	public function compose($view){
		$view->with('data', null);
	}
}
