<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tabs extends Component
{
    /**
     * All tab options.
     *
     * @var array
     */
    public array $tabs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tabs)
    {
        $this->tabs = $tabs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.tabs');
    }
}
