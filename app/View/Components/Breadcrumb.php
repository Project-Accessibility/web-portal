<?php

namespace App\View\Components;

use Illuminate\Routing\Route;
use Illuminate\View\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Breadcrumb extends Component
{
    public array $paths = [];

    public function __construct()
    {
        $url = parse_url(url()->current());
        $schemeHost = $url['scheme'] . '://' . $url['host'];

        $pathSplit = array_values(array_filter(explode('/', $url['path'])));

        $this->paths[] = [
            'view' => 'home',
            'url' => $schemeHost . '/',
        ];

        foreach ($pathSplit as $key => $path) {
            $fullPath = end($this->paths)['url'] . $path . '/';
            if ($route = $this->getRoute($fullPath)) {
                $view = $this->getView($route) ?? $path;
                $this->paths[] = [
                    'view' => $view,
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

    private function getView(Route $route): ?string
    {
        return $route->defaults['view'] ?? null;
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}
