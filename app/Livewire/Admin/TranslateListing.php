<?php

namespace App\Livewire\Admin;

use App\Models\Translation as TranslationModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class TranslateListing extends Component
{
    public function render()
    {
        $translation = TranslationModel::orderBy('created_at', 'desc')->paginate(50);

        return view('livewire.admin.translate-listing', ['translation' => $translation])
            ->layout('components.layouts.admin', []);
    }
}
