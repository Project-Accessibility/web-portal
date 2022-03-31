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
     * @var string
     */
    public string $label;

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
    public $value;

    /**
     * The placeholder
     *
     * @var string|null
     */
    public string|null $placeholder;

    /**
     * The extra data
     *
     * @var array|null
     */
    public array|null $extraData;

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
        string $label,
        string $name,
        mixed $value = null,
        string $placeholder = null,
        array $extraData = null,
    ) {
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->extraData = $extraData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.input');
    }
}
