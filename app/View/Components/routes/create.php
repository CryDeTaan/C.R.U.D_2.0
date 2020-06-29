<?php

namespace App\View\Components\routes;

use Illuminate\View\Component;

class create extends Component
{
    public $uri;
    public $controller;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($uri, $controller)
    {
        $this->uri = $uri;
        $this->controller = $controller;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.routes.create');
    }
}
