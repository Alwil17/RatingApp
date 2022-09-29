<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Inputbs4 extends Component
{
    public $name;
    public $type;
    public $label;
    public $required;
    public $autofocus;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $type, $label, $value = '', $required = false, $autofocus = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
        $this->required = $required;
        $this->autofocus = $autofocus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputbs4');
    }
}
