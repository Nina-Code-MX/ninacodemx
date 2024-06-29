<?php

namespace App\Livewire\Public;

use Illuminate\Http\Request;
use Livewire\Component;

class Portfolio extends Component
{
    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'portfolio';
    public $pageTitle = 'Portafolio';

    public function mount(Request $request, $lang = null)
    {
        $this->pageTitle = __('Portafolio');
    }

    public function render()
    {
        return view('livewire.public.portfolio', [
            'portfolios' => \App\Models\Portfolio::orderBy('project_date', 'desc')->get()
        ])
            ->layout('components.layouts.app', [
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }
}
