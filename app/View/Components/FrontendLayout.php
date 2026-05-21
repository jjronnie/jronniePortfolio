<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class FrontendLayout extends Component
{
    public bool $hideNav = false;

    public function render(): View
    {
        return view('layouts.frontend');
    }
}
