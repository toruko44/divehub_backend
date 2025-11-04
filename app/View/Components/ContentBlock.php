<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentBlock extends Component
{
    public $blocks;
    /**
     * Create a new component instance.
     */
    public function __construct($blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-block');
    }
}
