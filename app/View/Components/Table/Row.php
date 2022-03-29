<?php

namespace App\View\Components\Table;

use App\Utils\TableLink;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Row extends Component
{
    public Collection $rowItems;
    public ?Collection $tableLinks;

    public function __construct(array $item, array $keys = [], Collection $tableLinks = null)
    {
        if(! $this->everyArrayItemIsString($keys)) {
            return;
        }

        $this->rowItems = $this->getRowItems($item, $keys);
        $this->tableLinks = $this->mapToLinks($item, $tableLinks);
    }

    private function everyArrayItemIsString($array): bool
    {
        return collect($array)->every(fn ($value) =>
            gettype($value) == 'string'
        );
    }

    private function getRowItems(array $item, array $keys): Collection
    {
        return collect($keys)->map(function (string $key) use ($item) {
            $keysArray = explode('.', $key);
            $rowItem = $item[$keysArray[0]];

            for($index = 1; $index < count($keysArray); $index++) {
                $rowItem = $item[$keysArray[$index]];
            }

            return $rowItem;
        });
    }

    private function mapToLinks(array $item, Collection $tableLinks): Collection
    {
        return $tableLinks->mapWithKeys(function (TableLink $tableLink) use ($item) {
            return $tableLink->getUrlWithName($item);
        });
    }

    public function render()
    {
        return view('components.table.row');
    }
}
