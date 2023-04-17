<?php

namespace App\Http\Livewire\Auth;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Livewire\Component;

class Signout extends Component
{
    public $pageId = 'signout';
    public $pageTitle = 'Sign Out';

    public function mount(Request $request)
    {
        LocaleHelper::detectLocale($request, $this->pageId);
        $this->pageTitle = __('Sign In');
    }

    public function render()
    {
        return view('livewire.auth.signout')
            ->layout('layouts.auth', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
