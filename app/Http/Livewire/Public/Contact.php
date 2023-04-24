<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Livewire\Component;

class Contact extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'contact';
    public $pageTitle = 'Contact Us';

    public $contact = [];

    public function mount(Request $request)
    {
        LocaleHelper::detectLocale($request, $this->pageId);

        $this->heroData['h1'] = __('pages/contact.hero.h1');
        $this->heroData['h2'] = __('pages/contact.hero.h2');
        $this->heroData['p'] = __('pages/contact.hero.p');
        // $this->heroData['action'] = ['lable' => __('Contactenos'), 'route' => route('home', ['locale' => app()->getLocale()])];
        $this->pageTitle = __('Contactenos');
    }

    public function render()
    {
        return view('livewire.public.contact')
            ->layout('layouts.app', [
                'heroData' => $this->heroData,
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }

    public function saveContact()
    {
        \Log::debug('saveContact', $this->contact);
    }
}
