<?php

namespace App\Traits;

use App\Contracts\Commentable;
use App\Models\Comment;
use Exception;

trait CanComment{

	public function comments(){
		return $this->hasMany(Comment::class);
	}

	public function addComment(Commentable $commentable): self{
		(new Comment())->user()
		               ->associate($this)
		               ->commentable()
		               ->associate($commentable)
		               ->save();

		return $this;
	}

	public function removeComment(Comment $comment): self{
		if($this->id != $comment->user()->id){
			return $this;
		}

		try{
			$comment->delete();
		}
		catch(Exception $e){
			return $this;
		}

		return $this;
	}
}
