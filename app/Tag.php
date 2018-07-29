<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Tags kunnen bij meerdere posts horen en we willen de naam hebben en niet het id
class Tag extends Model
{
    public function posts()
    {
    	return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName()
    {
    	return 'name';
    }
}
