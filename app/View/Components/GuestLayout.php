<?php

namespace App\View\Components;

use Illuminate\Http\Client\Request;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {

        if(\str_starts_with(request()->getRequestUri(), '/embed')){
            return view('layouts.guest.embed');
        }
        return view('layouts.guest.'.config('config.theme'));
    }
}
