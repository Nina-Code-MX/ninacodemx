<?php

namespace App\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Terms extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'terms';
    public $pageTitle = 'Términos y Condiciones';

    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);
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
