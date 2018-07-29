<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

//Dit is de controller voor de blog pagina in de backend, dus niet voor het archief of de homepage.

class BlogController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Controleer of gebruiker admin of editor is en toon 5 blog posts per pagina met paginate. 
    public function index()
    {
        if (Auth::user()->isAdminOrEditor()) {
            $posts = Post::paginate(5);
        } else {
            $posts = Auth::user()->posts()->pageinate(5);
        }

        return view('admin.blog.index', ['model' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create')->with('model', new Post());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // Vraag de benodigde variabelen op die zijn ingevoerd in de bijbehorende form in de view met request (alleen die) en sla ze op in de database
    public function store(Request $request)
    {
        Auth::user()->posts()->save(
            new Post($request->only(['title','slug',
            'published_at','excerpt','body']))
        );

        return redirect()->route('blog.index')->with('status', 'The post was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $blog)
    {
        return view('admin.blog.edit')->with('model', $blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    // Check of de gebruiker mag bewerken, zo niet, dan terugsturen naar de index pagina van blog. Zo ja, dan worden de variabelen aangepast in de database.
    public function update(Request $request, Post $blog)
    {
        if (Auth::user()->cant('update', $blog)) {
            return redirect()->route('blog.index')->with('status', 'You do not have permission to edit that post.');
        }

        $blog->fill($request->only(['title','slug',
            'published_at','excerpt','body']))->save();

        return redirect()->route('blog.index')->with('status', 'The post was updated.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    // Check of een gebruiker mag verwijderen, zo niet, dan terugsturen. Zo ja, verwijderen en berichten dat het gelukt is, dan terugsturen.
    public function destroy(Post $blog)
    {
        if (Auth::user()->cant('delete', $blog)) {
            return redirect()->route('blog.index')->with('status', 'You do not have permission to delete that post.');
        }

        $blog->delete();

        return redirect()->route('blog.index')->with('status', 'The post was deleted.');        
    }
}
