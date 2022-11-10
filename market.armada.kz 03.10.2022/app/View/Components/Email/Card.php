<?php

namespace App\View\Components\Email;

use Illuminate\View\Component;

class Card extends Component
{
    public $card;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($card)
    {
        $this->card = $card;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.email.card');
    }
}
