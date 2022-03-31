<?php

namespace App\View\Components;

use Illuminate\Routing\Route;
use Illuminate\View\Component;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Breadcrumb extends Component
{
    public array $paths = [];

    public function __construct()
    {
        $url = parse_url(url()->current());
        $schemeHost = $url['scheme'] . '://' . $url['host'] . ':' . $url['port'];

        $pathSplit = array_values(array_filter(explode('/', $url['path'])));

        $this->paths[] = [
            'display' => 'home',
            'url' => $schemeHost . '/',
        ];

        foreach ($pathSplit as $path) {
            $fullPath = end($this->paths)['url'] . $path . '/';
            if ($route = $this->getRoute($fullPath)) {
                $view = $this->getDisplay($route) ?? $path;
                $this->paths[] = [
                    'display' => $view,
                    'url' => $fullPath,
                ];
            }
        }
    }

    private function getRoute(string $path): ?Route
    {
        try {
            return app('router')
                ->getRoutes()
                ->match(app('request')->create($path));
        } catch (NotFoundHttpException) {
            return null;
        }
    }

    private function getDisplay(Route $route): ?string
    {
        return $route->defaults['display'] ?? null;
    }

    public function render(): View
    {
        return view('components.breadcrumb');
    }
}
