<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use App\Models\Service;
use App\Models\Translation;
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

            $Services = $this->getSlugTranslation();

            if ($Services) {
                $Services = $Services->toArray();
            } else {
                abort(404);
            }
        } else {
            $Services = \App\Models\Service::orderBy('order')->get()->toArray();
        }
        
        return view('livewire.public.services' . ($this->slug ? '_slug' : ''), ['services' => $Services])
            ->layout('layouts.app', $layoutSet);
    }

    /**
     * Get slug translation
     * @return Service
     */
    private function getSlugTranslation(): Service
    {
        if (app()->getLocale() === 'es') {
            return Service::where('slug', $this->slug)->get()->first();
        }

        $Translation = Translation::where('model_name', 'Service')->whereJsonContains('value->slug', $this->slug)->get()->first();

        if (!$Translation) {
            return Service::where('slug', $this->slug)->get()->first();
        }

        $Service = Service::find($Translation->model_id);

        if (!$Service) {
            return Service::where('slug', $this->slug)->get()->first();
        }

        return $Service;
    }
}
