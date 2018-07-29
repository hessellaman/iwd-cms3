<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;

class PostPresenter extends Presenter
{
	// De publicatie datum kan zo worden berekend voor een view. Dit hoort niet thuis in een view maar ook niet in een model natuurlijk!
    public function publishedDate()
    {
        return Carbon::parse($this->published_at)->toFormattedDateString();
    }
}