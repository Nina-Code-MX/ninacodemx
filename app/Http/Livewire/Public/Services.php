<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Services extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'services';
    public $pageTitle = 'Servicios';
    public $slug = null;

    public function mount(Request $request, $slug = null)
    {
        $this->slug = $slug;
        LocaleHelper::detectLocale($request, $this->pageId);

        if (!$this->slug) {
            $this->heroData['h1'] = __('pages/services.hero.h1');
            $this->heroData['h2'] = __('pages/services.hero.h2');
            $this->heroData['p'] = __('pages/services.hero.p');
            $this->heroData['action'] = ['label' => __('Precios'), 'route' => route(app()->getLocale() . '.pricing', ['locale' => app()->getLocale()])];
        }

        $this->pageTitle = __('Servicios');
    }

    public function render()
    {
        $layoutSet = [
            'heroData' => $this->heroData,
            'pageId' => $this->pageId,
            'pageTitle' => $this->pageTitle
        ];

        if ($this->slug) {
            unset($layoutSet['heroData']);
            try {
                $Services = \App\Models\Service::orderBy('order')->where('slug', $this->slug)->first()->toArray();
            } catch (\Error $e) {
                abort(404);
            }
        } else {
            $Services = \App\Models\Service::orderBy('order')->get()->toArray();
        }
        
        return view('livewire.public.services' . ($this->slug ? '_slug' : ''), ['services' => $Services])
            ->layout('layouts.app', $layoutSet);
    }
}
