<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public string $type;

    /**
     * The alert message.
     *
     * @var string|null
     */
    public string|null $link;

    /**
     * FormId to submit (Only when deleting).
     *
     * @var string|null
     */
    public string|null $formId;

    /**
     * Text to show in popup (Only used when deleting).
     *
     * @var string|null
     */
    public string|null $removeText;

    /**
     * Create a new component instance.
     * @param string $type
     * @param string|null $link
     * @param string|null $formId
     * @param string|null $removeText
     */
    public function __construct(
        string $type = 'primary',
        string|null $link = null,
        string|null $formId = null,
        string|null $removeText = null,
    ) {
        $this->type = $type;
        $this->link = $link;
        $this->formId = $formId;
        $this->removeText = $removeText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.button');
    }
}
