<?php

namespace App\View\Components\icons;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class room-service extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icons.room-service');
    }
}
