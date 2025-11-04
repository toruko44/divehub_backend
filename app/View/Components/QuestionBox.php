<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuestionBox extends Component
{
    public $url;
    public $imagePath;
    public $title;
    public $content;
    public $tagLabel;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $imagePath = null, $title, $content, $tagLabel = '一般')
    {
        $this->url = $url;
        $this->imagePath = $imagePath;
        $this->title = $title;
        $this->content = $content;
        $this->tagLabel = $tagLabel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.question-box');
    }
}
