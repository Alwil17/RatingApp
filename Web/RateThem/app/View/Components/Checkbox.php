<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $name;
    public $label;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $value = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
