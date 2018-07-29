<?php

namespace App;

class Comment extends Model
{
    // Deze kolommen in de tabel van comments mogen we invulling geven
	protected $fillable = [
        'body',
        'post_id',
        'user_id'
    ];

    // Een comment hoort bij een bepaalde blog post
    public function post()
    {
    	return $this->belongsTo(Post::class);
    }

    // Een comment wordt geplaatst door een bepaalde gebruiker
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    // Of een gebruiker een comment kan editen is afhankelijk van zijn rol
    public function userCanEdit(User $user)
    {
        return $user->isAdminOrEditor();
    }
}
