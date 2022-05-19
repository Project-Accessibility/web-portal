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
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Tabs extends Component
{
    public string $title;
    public array $tabs;
    public ?string $currentTab;

    public function __construct(string $title, array $tabs)
    {
        $tabs = array_map(function ($tab) {
            return strtolower($tab);
        }, $tabs);

        $tabQuery = strtolower(request()->query('tab'));

        if (count($tabs) < 0) {
            throw new Exception(
                'There needs to be at least 1 tab given to the tabs component.',
            );
        }

        abort_if(
            $tabQuery !== '' && !in_array($tabQuery, $tabs),
            404,
            'Onjuiste tab',
        );

        $this->title = $title;
        $this->tabs = $tabs;
        $this->currentTab = in_array($tabQuery, $tabs) ? $tabQuery : $tabs[0];
    }

    public function render(): View
    {
        return view('components.tabs');
    }
}
