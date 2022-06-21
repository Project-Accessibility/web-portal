<?php

namespace App\View\Components\Table;

use App\Utils\TableLink;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Table extends Component
{
    public array $headers;
    public array $items;
    public array $keys;
    public ?TableLink $rowLink;
    public ?Collection $tableLinks;

    public function __construct(
        array $headers,
        array $items,
        array $keys,
        TableLink $rowLink = null,
        Collection $tableLinks = null,
    ) {
        $this->headers = $headers;
        $this->items = $items;
        $this->keys = $keys;
        $this->rowLink = $rowLink;
        $this->tableLinks = $tableLinks;
    }

    public function render(): View
    {
        return view('components.table.table');
    }
}
