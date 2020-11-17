<?php

namespace App\Traits;

use App\Contracts\Likeable;
use App\Models\Like;

trait CanLike{

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function addLike(Likeable $likeable): self{
        if($this->hasLiked($likeable)){
            return $this;
        }

        (new Like())->user()
                    ->associate($this)
                    ->likeable()
                    ->associate($likeable)
                    ->save();

        return $this;
    }

    public function hasLiked(Likeable $likeable): bool{
        if(!$likeable->exists){
            return false;
        }

        return $likeable->likes()
                        ->whereHas('user', fn($q) => $q->whereId($this->id))
                        ->exists();
    }

    public function removeLike(Likeable $likeable): self{
        if(!$this->hasLiked($likeable)){
            return $this;
        }

        $likeable->likes()
                 ->whereHas('user', fn($q) => $q->whereId($this->id))
                 ->delete();

        return $this;
    }
}
