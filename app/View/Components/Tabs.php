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
     * The current tab.
     *
     * @var string
     */
    public string $currentTab;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tabs, $currentTab)
    {
        $this->tabs=$tabs;
        $this->currentTab=$currentTab;
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
