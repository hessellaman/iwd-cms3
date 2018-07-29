<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

// We gebruiken presenters van onze grote vriend Jeff voor het uitvoeren van bepaalde logica voordat een view verder gaat met de data, een tussenstap tussen een view en een model.

class PagePresenter extends Presenter
{
	// Spaties toevoegen voor form gebruik
    public function paddedTitle()
    {
        $padding = str_repeat('&nbsp;', $this->depth * 4);
        return $padding.$this->title;
    }

    // Voor het presenteren van een dropdown menu wanneer een pagina kinderen heeft.
    public function dropDownClass()
    {
        return $this->children->count() ? 'dropdown' : '';
    }
}