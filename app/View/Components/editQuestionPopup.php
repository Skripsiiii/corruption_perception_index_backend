<?php

namespace App\View\Components;

use Illuminate\View\Component;

class editQuestionPopup extends Component
{

    // public $questionId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->questionId = $questionId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.popups.edit-question-popup');
    }
}
