<?php

namespace App\Livewire\Admin;

use App\Models\ContactForm as ContactFormModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class ContactListing extends Component
{
    public function render()
    {
        $contact = ContactFormModel::orderBy('created_at', 'desc')->paginate(50);

        return view('livewire.admin.contact-listing', ['contact' => $contact])
            ->layout('components.layouts.admin', []);
    }
}
