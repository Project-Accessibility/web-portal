<?php

namespace App\Utils;

use Illuminate\Support\Collection;

class TableLink
{
    public string $name;
    public string $route;
    public ?Collection $parameters;

    public function __construct(
        string $name,
        string $route,
        Collection $parameters = null,
    ) {
        $this->name = $name;
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
                ) use ($item) {
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

    public function getUrlWithName(array $item = null): array
    {
        return [$this->name => $this->createUrl($item)];
    }
}
