<?php

namespace App\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Livewire\Component;

class Home extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'home';
    public $pageTitle = 'Home';

    public function mount(Request $request)
    {
        LocaleHelper::detectLocale($request, $this->pageId);

        $this->heroData['h1'] = __('pages/home.hero.h1');
        $this->heroData['h2'] = __('pages/home.hero.h2');
        $this->heroData['p'] = __('pages/home.hero.p');
        $this->heroData['action'] = ['label' => __('Contactenos'), 'route' => route(app()->getLocale() . '.contact', ['locale' => app()->getLocale()])];
        $this->pageTitle = __('pages/home.hero.h1');
    }

    public function render()
    {
        return view(
            'livewire.public.home', 
            [
                'services' => \App\Models\Service::orderBy('order')->get()->toArray(),
                'teams' => \App\Models\Team::with(['teamSocials'])->orderBy('order')->get()->toArray(),
            ]
        )
        ->layout('components.layouts.app', [
            'heroData' => $this->heroData,
            'pageId' => $this->pageId,
            'pageTitle' => $this->pageTitle
        ]);
    }
}
