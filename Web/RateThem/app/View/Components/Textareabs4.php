<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textareabs4 extends Component
{
    public $name;
    public $label;
    public $required;
    public $rows;
    public $autofocus;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $value = '', $rows = 3, $required = false, $autofocus = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->rows = $rows;
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
        return view('components.textareabs4');
    }
}
