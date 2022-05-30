<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * The input type.
     *
     * @var string
     */
    public string $type;

    /**
     * The label
     *
     * @var string|null
     */
    public ?string $label;

    /**
     * The name
     *
     * @var string
     */
    public string $name;

    /**
     * The value
     *
     */
    public mixed $value;

    /**
     * The placeholder
     *
     * @var string|null
     */
    public ?string $placeholder;

    /**
     * The extra data
     *
     * @var array|null
     */
    public ?array $extraData;

    public ?string $required;

    public bool $disabled;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $name
     * @param mixed $value
     * @param string|null $placeholder
     * @param array|null $extraData
     */
    public function __construct(
        string $type,
        string $name,
        string $label = null,
        mixed $value = null,
        string $placeholder = null,
        array $extraData = null,
        bool $required = false,
        bool $disabled = false,
    ) {
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->extraData = $extraData;
        $this->required = $required;
        $this->disabled = $disabled;
    }

    public function render(): View
    {
        return view('components.input');
    }
}
