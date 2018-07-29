<?php

namespace App\Http\Controllers;

use Auth;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdminOrEditor()) {
            $pages = Page::defaultOrder()->withDepth()->paginate(5); // withDepth zorgt ervoor dat er ingesprongen wordt bij het tonen van de lijst met pages, wanneer een page een kind van een ouder is. Paginate zorgt ervoor dat er niet meer dan 5 pages per pagina getoond worden.
        } else {
            $pages = Auth::user()->pages()->pageinate(5);
        }
        
        return view('admin.pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.create')->with([
            'model' => new Page(),
            'orderPages' => Page::defaultOrder()->withDepth()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Een nieuwe pagina kan hiermee worden opgeslagen door de ingevoerde informatie op te vragen van de form in de view.
    public function store(Request $request)
    {
        Auth::user()->pages()->save(new Page($request->only([
            'title','url','content'])));

        return redirect()->route('pages.index')->with('status', 'The page has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        if (Auth::user()->cant('update', $page)) {
            return redirect()->route('pages.index');
        }

        return view('admin.pages.edit', [
            'model' => $page,
            'orderPages' => Page::defaultOrder()->withDepth()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */

    // De plaats waar een pagina staat in de menubalk kan worden gewijzigd. Er kan worden aangegeven of een pagina voor of na een andere pagina moet komen te staan, en of een pagina een kind van een andere pagina moet worden (dropdown). updatePageOrder onderaan wordt hiervoor gebruikt.
    public function update(Request $request, Page $page)
    {
        if (Auth::user()->cant('update', $page)) {
            return redirect()->route('pages.index');
        }

        $page->fill($request->only(['title','url','content']))->save();

        if ($response = $this->updatePageOrder($page, $request)) {
            return $response;
        }

        return redirect()->route('pages.index')->with('status', 'The page was updated.');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */

    // Verwijderen van pagina
    public function destroy(Page $page)
    {
        if (Auth::user()->cant('delete', $page)) {
            return redirect()->route('pages.index');
        }

        $page->delete();

        return redirect()->route('pages.index')->with('status', 'The page was deleted.');
    }

    // Om een pagina van volgorde te veranderen wordt updateOrder in Page.php gebruikt. Hierbij wordt gebruik gemaakt van de package Kalnoy/Nestedset.
    protected function updatePageOrder(Page $page, Request $request)
    {
        if ($request->has('order', 'orderPage')) {
            
            if ($page->id == $request->orderPage) {
                return redirect()->route('pages.index')->with('status', 'Een pagina kan niet met zichzelf worden gesorteerd.');
            }

            $page->updateOrder($request->order, $request->orderPage);
        }
    }
}
