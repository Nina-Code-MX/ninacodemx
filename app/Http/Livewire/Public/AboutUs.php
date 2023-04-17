<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Livewire\Component;

class AboutUs extends Component
{
    public $pageId = 'aboutus';
    public $pageTitle = 'About Us';

    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);
        $this->pageTitle = __('About Us');
    }

    public function render()
    {
        return view('livewire.public.about-us')
            ->layout('layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
