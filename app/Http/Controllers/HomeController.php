<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Toon alleen de meest recente blog post op de homepage

        $published = Post::with('user')
                        ->where('published_at', '<', Carbon::now()) // Een post kan worden aangemaakt met een publish datum die in de toekomst ligt, hiermee zorgen we dat deze niet getoond worden ('<'). 
                        ->orderBy('published_at', 'desc')
                        ->paginate(3); // Zo beperken we het aantal posts dat te zien is op de frontpage. Hier moeten alleen de 3 meest recente posts komen te staan

        return view('home.index')->with('posts', $published);    
    }
}
