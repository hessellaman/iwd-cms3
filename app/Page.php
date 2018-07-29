<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laracasts\Presenter\PresentableTrait;

// We gebruiken custom packages voor het weergeven van pagina en het bepalen waar een pagina in de menubalk komt te staan. 

class Page extends Model
{
    use NodeTrait;
    use PresentableTrait;

    protected $presenter = 'App\Presenters\PagePresenter';
    
    protected $fillable = [
        'title',
        'url',
        'content'       
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    // Hier wordt een package Kalnoy\Nestedset gebruikt om de volgorde van een pagina aan te kunnen passen. Pagina's kunnen voor of achter een bepaalde pagina komen te staan. De benodigde informatie wordt toegestuurd vanuit de PagesController. Ja ik geef toe dat ik dit niet zelf heb bedacht.
    public function updateOrder($order, $orderPage) {
        $relative = Page::findOrFail($orderPage);

        if ($order == 'before') {
            $this->beforeNode($relative)->save();
        } else if ($order == 'after') {
            $this->afterNode($relative)->save();
        } else {
            $relative->appendNode($this);
        }

        Page::fixTree();
    }
}
