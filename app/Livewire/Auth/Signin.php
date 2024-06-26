<?php

namespace App\Livewire\Auth;

use Illuminate\Http\Request;
use Livewire\Component;

class Signin extends Component
{
    public $pageId = 'signin';
    public $pageTitle = 'Sign In';

    public function mount(Request $request)
    {
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
