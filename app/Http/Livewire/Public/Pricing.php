<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Validator;
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
        $this->pageTitle = __('Precios');
    }

    public function render()
    {
        $services = Service::orderBy('order')->get();

        return view('livewire.public.pricing', ['services' => $services])
            ->layout('layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }

    public function formDataProcess()
    {
        $this->validate([
            'formData.name' => 'required',
            'formData.lastname' => 'required',
            'formData.company' => 'required',
            'formData.email' => 'required|email',
            'formData.phone' => 'required',
            'formData.phoneCountry' => 'required',
            'formData.service' => 'required',
            'formData.reCaptcha' => 'required',
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
