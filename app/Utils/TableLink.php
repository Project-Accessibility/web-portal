<?php

namespace App\Utils;

use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

class TableLink
{
    public string $route;
    public ?Collection $parameters;

    public function __construct(string $route, Collection $parameters = null)
    {
        $this->route = $route;
        $this->parameters = $parameters;
    }

    public function createUrl(array $item = null): string
    {
        if ($this->parameters) {
            if ($item) {
                $tempRouteKeys = $this->parameters->mapWithKeys(function (
                    TableLinkParameter $tableLinkParameter,
                ) use ($item) {
                    return isset($tableLinkParameter->itemIndex)
                        ? [
                            $tableLinkParameter->routeParameter =>
                                $item[$tableLinkParameter->itemIndex],
                        ]
                        : [
                            $tableLinkParameter->routeParameter =>
                                $tableLinkParameter->routeValue,
                        ];
                });
            } else {
                $tempRouteKeys = $this->parameters->mapWithKeys(function (
                    TableLinkParameter $tableLinkParameter,
                ) {
                    return [
                        $tableLinkParameter->routeParameter =>
                            $tableLinkParameter->routeValue,
                    ];
                });
            }
        } else {
            $tempRouteKeys = null;
        }

        return route(
            $this->route,
            $tempRouteKeys && $tempRouteKeys->count() > 0
                ? $tempRouteKeys->toArray()
                : null,
        );
    }

    private function getRoute(): Route
    {
        return app('router')
            ->getRoutes()
            ->getByName($this->route);
    }

    public function getUrlWithName(array $item = null): array
    {
        $route = $this->getRoute();
        $url = $this->createUrl($item);

        return [$route->defaults['display'] ?? $route->getName() => $url];
    }
}
