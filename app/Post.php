<?php

namespace App;

use Laracasts\Presenter\PresentableTrait;
use Carbon\carbon;

class Post extends Model
{
    use PresentableTrait;

    // Zie uitleg bij de presenters    
    protected $presenter  = 'App\Presenters\PostPresenter';

    // Deze variabelen mogen worden ingevuld in de database.
    protected $fillable = [
        'title',
        'slug',
        'body',
        'excerpt',
        'published_at'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function addComment($body)
    {
        $this->comments()->create(compact('body'));
    }

    // Voor het tonen van posts uit een bepaalde maand/jaar
    public function scopeFilter($query, $filters)
    {
        // Afhankelijk van of de filter een maand of een jaar heeft
        if (isset($filters['month'])) {
            $query->whereMonth('created_at', Carbon::parse($filters['month'])->month);
        }
        
        if (isset($filters['year'])) {
            $query->whereYear('created_at', $filters['year']);
        }
    }

    public static function archives()
    {
        // Archives worden op volgorde van tijd gezet        
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
