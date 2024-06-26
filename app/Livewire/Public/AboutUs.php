<?php

namespace App\Livewire\Public;

use Illuminate\Http\Request;
use Livewire\Component;

class AboutUs extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'aboutus';
    public $pageTitle = 'Acerca de nosotros';

    public function mount(Request $request)
    {
        $this->pageTitle = __('Acerca de nosotros');
    }

    public function render()
    {
        return view('livewire.public.about-us')
            ->layout('components.layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
