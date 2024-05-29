<?php

namespace App\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class AboutUs extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'aboutus';
    public $pageTitle = 'Acerca de nosotros';

    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);
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
