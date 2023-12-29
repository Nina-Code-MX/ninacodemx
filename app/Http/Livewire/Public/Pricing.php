<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use App\Models\Service;
use Illuminate\Http\Request;
use Livewire\Component;

class Pricing extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'pricing';
    public $pageTitle = 'Precios';
    public $formData = [
        'name' => '',
        'lastname' => '',
        'company' => '',
        'email' => '',
        'phone' => '',
        'phoneCountry' => '',
        'service' => '',
        'reCaptcha' => ''
    ];
    public $submit_message = '';

    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);

        $this->heroData['h1'] = __('Precios');
        $this->heroData['h2'] = __('pages/pricing.h2');
        $this->heroData['p'] = __('pages/pricing.hero.p');

        $this->pageTitle = __('Precios');
    }

    public function render()
    {
        $services = Service::orderBy('order')->get();

        return view('livewire.public.pricing', ['services' => $services])
            ->layout('layouts.app', [
                'heroData' => $this->heroData,
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }

    public function formDataProcess()
    {
        $this->submit_message = '';

        $this->validate([
            'formData.name' => 'required|min:2',
            'formData.lastname' => 'required|min:2',
            'formData.company' => 'required|min:2',
            'formData.email' => 'required|email',
            'formData.phone' => 'required|min:10',
            'formData.phoneCountry' => 'required|min:2',
            'formData.service' => 'required|exists:services,id',
            'formData.reCaptcha' => 'required|min:1',
        ],
        [],
        [
            'formData.name' => __('Nombre(s)'),
            'formData.lastname' => __('Apellido(s)'),
            'formData.company' => __('Company'),
            'formData.email' => __('Email'),
            'formData.phone' => __('Teléfono'),
            'formData.phoneCountry' => __('País'),
            'formData.service' => __('mainmenu.services'),
            'formData.reCaptcha' => __('ReCaptcha'),
        ]);

        $this->submit_message = 'Success';
        sleep(5);
    }
}
