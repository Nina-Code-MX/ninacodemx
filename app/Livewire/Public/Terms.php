<?php

namespace App\Livewire\Public;

use Illuminate\Http\Request;
use Livewire\Component;

class Terms extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'terms';
    public $pageTitle = 'Términos y Condiciones';

    public function mount(Request $request)
    {
        $this->pageTitle = __('Términos y Condiciones');
    }

    public function render()
    {
        return view('livewire.public.terms')
            ->layout('components.layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
