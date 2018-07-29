<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\Posts;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Dit is de controller voor de front-end (het blog zelf) en bepaalt welke view bepaalde informatie wordt toegestuurd.
class BlogPostController extends Controller
{    
    // Hiermee worden de posts op volgorde gezet en kan er uiteindelijk worden gefilterd met eens filter scope in Post.php 
    public function index() 
    {
        $posts = Post::latest()
            ->filter(request()->only(['month', 'year']))
            ->get();

        return view('blog.index', compact('posts'));
    }

    // Voor een specifieke blog pagina
    public function view($slug) {
        $post = Post::with('user')
                    ->where([
                        ['slug','=', $slug],
                        ['published_at', '<', Carbon::now()]
                    ])
                    ->firstOrFail();
                    
        return view('blog.view')->with('post', $post);
    }
}
