<?php

namespace App\Livewire\Public;

use Illuminate\Http\Request;
use Livewire\Component;

class Privacy extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'privacy';
    public $pageTitle = 'Aviso de Privacidad';

    public function mount(Request $request, $lang = null)
    {
        $this->pageTitle = __('Aviso de Privacidad');
    }

    public function render()
    {
        return view('livewire.public.privacy')
            ->layout('components.layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
