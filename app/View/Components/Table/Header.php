<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;
use Illuminate\View\View;

class Header extends Component
{
    public array $headers;
    public int $amountOfLinks;

    public function __construct(array $headers = [], int $amountOfLinks = 0)
    {
        if (!$this->everyArrayItemIsString($headers)) {
            return;
        }

        $this->headers = $headers;
        $this->amountOfLinks = $amountOfLinks;
    }

    private function everyArrayItemIsString($array): bool
    {
        return collect($array)->every(
            fn($value) => gettype($value) == 'string',
        );
    }

    public function render(): View
    {
        return view('components.table.header');
    }
}
