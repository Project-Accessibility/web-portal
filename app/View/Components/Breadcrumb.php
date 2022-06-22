<?php

namespace App\View\Components;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Breadcrumb extends Component
{
    public array $paths = [];
    private array $modelTitles = [
        'researches' => 'title',
        'questionnaires' => 'title',
        'sections' => 'title',
        'questions' => 'title',
        'participants' => 'code',
    ];

    public function __construct()
    {
        $url = parse_url(url()->full());

        if (!isset($url['path'])) {
            return;
        }

        $schemeHost =
            $url['scheme'] .
            '://' .
            $url['host'] .
            (isset($url['port']) ? ':' . $url['port'] : null);

        $pathSplit = array_values(array_filter(explode('/', $url['path'])));

        $previousRoute = null;
        foreach ($pathSplit as $path) {
            $fullPath =
                (count($this->paths) > 0
                    ? end($this->paths)['url']
                    : $schemeHost . '/') .
                $path .
                '/';
            if ($route = $this->getRoute($fullPath)) {
                $view =
                    $this->getDisplay($route) ??
                    ($this->getModelTitle($previousRoute, (int) $path) ??
                        $path);
                $this->paths[] = [
                    'display' => $view,
                    'url' => $fullPath,
                ];

                $previousRoute = $route;
            }
        }

        if (isset($url['query'])) {
            $query = [];
            parse_str($url['query'], $query);
            if (isset($query['tab'])) {
                $tab = $query['tab'];
                $this->paths[] = [
                    'display' => $tab,
                    'url' => end($this->paths)['url'] . '?tab=' . $tab,
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

    private function getModelTitle(Route $route, int $id): ?string
    {
        if (!array_key_exists('model', $route->defaults)) {
            return null;
        }

        $model = $route->defaults['model'];
        $modelColumn = $this->modelTitles[$model] ?? 'title';

        return DB::table($model)->find($id)->$modelColumn;
    }

    public function render(): View
    {
        return view('components.breadcrumb');
    }
}
