<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

// Controller voor het verzorgen van tags die horen bij posts.
class TagsController extends Controller
{
    public function index(Tag $tag)
    {    	
    	$posts = $tag->posts;

    	return view('blog.index', compact('posts'));
    }
}
