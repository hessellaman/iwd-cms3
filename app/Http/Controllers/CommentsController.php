<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function store (Post $post)
    {	
      	// We controleren of de gebruiker is ingelogd, zo niet dan kan hij geen bericht plaatsen
      	if(Auth::Guest()) {
              return back()->withErrors([
                  'message' => 'Je moet ingelogd zijn om een bericht te kunnen plaatsen.'
              ]);
        }

        // Een comment wordt opgevraagd van de comment form die is ingevuld, vervolgens worden de identifiers van de bijbehorende post en de gebruiker met route model binding gekoppeld aan een comment en in de table opgeslagen
        Comment::create([
          'body' => request('body'),
          'post_id' => $post->id,
          'user_id' => auth()->user()->id,
          ]);

  		  return back();
    }
    
    // Hiermee wordt een comment gewijzigd. De body wordt opgevraagd van de form en gewijzigd met update()
    public function update (Post $post, Comment $comment)
    {
    		$this->validate(request(),[
    			'body' => 'required'
    			]);

    		$comment->update(request([
    			'body']));

  	    return back();
	  }

    // Een comment kan worden verwijderd, hiervoor wordt eerst gecontroleerd of de gebruiker dit mag doen. Een admin/editor mag dit doen en de auteur van de comment zelf ook.
	  public function destroy (Comment $comment)
    {    	
    		if ($comment->userCanEdit(Auth::user()) || (Auth::user()->id == $comment->user_id)) {
    		    $comment->delete();
    		}

    		return back();   
    }
}
