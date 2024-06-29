<?php

namespace App\Livewire\Auth;

use Illuminate\Http\Request;
use Livewire\Component;

class Signout extends Component
{
    public $pageId = 'signout';
    public $pageTitle = 'Sign Out';

    public function mount(Request $request)
    {
        $this->pageTitle = __('Sign In');
    }

    public function render()
    {
        return view('livewire.auth.signout')
            ->layout('components.layouts.auth', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
