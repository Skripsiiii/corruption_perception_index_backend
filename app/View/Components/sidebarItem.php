<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sidebarItem extends Component
{

    public $href;
    public $name;
    public $icon;
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($href, $name, $icon, $color)
    {
        //
        $this->href = $href;
        $this->name = $name;
        $this->icon = $icon;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-item');
    }
}
