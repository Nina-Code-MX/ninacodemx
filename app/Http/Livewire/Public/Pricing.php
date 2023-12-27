<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
    ];
    public $submit_message = 'No errors';

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
        $this->submit_message = 'Success';
    }
}
