<?php

namespace App\Livewire\Admin;

use App\Models\Service as ServiceModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class ServiceListing extends Component
{
    public function render()
    {
        $service = ServiceModel::orderBy('created_at', 'desc')->paginate(50);

        return view('livewire.admin.service-listing', ['service' => $service])
            ->layout('components.layouts.admin', []);
    }
}
