<?php

namespace App\Utils;

class TableLinkParameter
{
    public string $routeParameter;
    public ?string $routeValue;
    public ?string $itemIndex;

    public function __construct(
        string $routeParameter,
        string $routeValue = null,
        string $itemIndex = null,
    ) {
        $this->routeParameter = $routeParameter;
        $this->routeValue = $routeValue;
        $this->itemIndex = $itemIndex;
    }
}
