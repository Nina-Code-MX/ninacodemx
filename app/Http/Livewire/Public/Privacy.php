<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Privacy extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'privacy';
    public $pageTitle = 'Aviso de Privacidad';

    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);
        $this->pageTitle = __('Aviso de Privacidad');
    }

    public function render()
    {
        return view('livewire.public.privacy')
            ->layout('layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
