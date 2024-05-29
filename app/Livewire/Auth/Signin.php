<?php

namespace App\Livewire\Auth;

use App\Helpers\LocaleHelper;
use Illuminate\Http\Request;
use Livewire\Component;

class Signin extends Component
{
    public $pageId = 'signin';
    public $pageTitle = 'Sign In';

    public function mount(Request $request)
    {
        LocaleHelper::detectLocale($request, $this->pageId);
        $this->pageTitle = __('Sign In');
    }

    public function render()
    {
        return view('livewire.auth.signin')
            ->layout('components.layouts.auth', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
