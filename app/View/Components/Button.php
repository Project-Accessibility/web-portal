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
   * Create a new component instance.
   * @param string $type
   * @param string|null $link
   */
  public function __construct(string $type, string|null $link = null)
  {
    $this->type = $type;
    $this->link = $link;
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
