<?php

namespace App\View\Components;

use App\Models\Film;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilmCard extends Component
{
    public Film $film;

    /**
     * Create a new component instance.
     */
    public function __construct(Film $film)
    {
        $this->film = $film;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.film-card');
    }
}
