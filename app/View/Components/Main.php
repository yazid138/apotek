<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    public $title;
    public $role;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $role = 'admin')
    {
        $this->title = $title;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.main');
    }
}
