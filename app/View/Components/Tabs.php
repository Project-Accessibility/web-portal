<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Tabs extends Component
{
    public string $title;
    public array $tabs;
    public ?string $currentTab;

    public function __construct(string $title, array $tabs)
    {
        if (count($tabs) < 0) {
            throw new Exception(
                'There needs to be at least 1 tab given to the tabs component',
            );
        }

        $this->title = $title;
        $this->tabs = $tabs;
        $this->currentTab = $tabQuery ?? $tabs[0];
    }

    public function render(): View
    {
        return view('components.tabs');
    }
}
