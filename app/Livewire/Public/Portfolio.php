<?php

namespace App\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Portfolio extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'portfolio';
    public $pageTitle = 'Portafolio';

    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);
        $localeDates = [
            'es' => 'es_MX',
            'en' => 'us_US'
        ];
        setlocale(LC_ALL, $localeDates[Cookie::get('lang') ?? 'es']);
        $this->pageTitle = __('Portafolio');
    }

    public function render()
    {
        return view('livewire.public.portfolio', ['portfolios' => \App\Models\Portfolio::orderBy('project_date', 'desc')->get()->toArray()])
            ->layout('components.layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
