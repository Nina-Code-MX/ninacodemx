<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Livewire\Component;

class Home extends Component
{
    public $pageId = 'home';
    public $pageTitle = 'Home';

    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);
        $this->pageTitle = env('APP_NAME');
    }

    public function render()
    {
        return view('livewire.public.home')
            ->layout('layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
