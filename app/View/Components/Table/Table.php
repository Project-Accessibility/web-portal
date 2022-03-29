<?php

namespace App\View\Components\Table;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Table extends Component
{
    public array $headers;
    public array $items;
    public array $keys;
    public Collection $tableLinks;

    public function __construct(
        array $headers,
        array $items,
        array $keys,
        Collection $tableLinks,
    ) {
        $this->headers = $headers;
        $this->items = $items;
        $this->keys = $keys;
        $this->tableLinks = $tableLinks;
    }

    public function render(): View
    {
        return view('components.table.table');
    }
}
