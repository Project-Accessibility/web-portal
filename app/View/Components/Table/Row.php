<?php

namespace App\View\Components\Table;

use App\Utils\TableLink;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Row extends Component
{
    public Collection $rowItems;
    public ?string $rowLink;
    public ?Collection $tableLinks;

    public function __construct(
        array $item,
        array $keys,
        TableLink $rowLink = null,
        Collection $tableLinks = null,
    ) {
        if (!$this->everyArrayItemIsString($keys)) {
            return;
        }

        $this->rowItems = $this->getRowItems($item, $keys);

        $this->rowLink = $rowLink ? $this->mapToLinks($item, $rowLink) : null;
        $this->tableLinks = $tableLinks
            ? $this->mapToLinks($item, $tableLinks)
            : null;
    }

    private function everyArrayItemIsString($array): bool
    {
        return collect($array)->every(
            fn($value) => gettype($value) == 'string',
        );
    }

    private function getRowItems(array $item, array $keys): Collection
    {
        return collect($keys)->map(function (string $key) use ($item) {
            $keysArray = explode('.', $key);
            $rowItem = $item[$keysArray[0]];

            for ($index = 1; $index < count($keysArray); $index++) {
                $rowItem = $item[$keysArray[$index]];
            }

            return $rowItem;
        });
    }

    private function mapToLinks(
        array $item,
        TableLink|Collection $tableLinks,
    ): string|Collection {
        if (get_class($tableLinks) === TableLink::class) {
            return $tableLinks->createUrl($item);
        } else {
            return $tableLinks->mapWithKeys(function (
                TableLink $tableLink,
            ) use ($item) {
                return $tableLink->getUrlWithName($item);
            });
        }
    }

    public function render()
    {
        return view('components.table.row');
    }
}
