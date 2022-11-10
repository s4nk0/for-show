<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class VerifyPhoneInputs extends Component
{
    public $label;
    public $form_class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $form_class = null)
    {
        $this->label = $label;
        $this->form_class = $form_class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.verify-phone-inputs');
    }
}
