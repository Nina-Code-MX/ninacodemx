<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|email', as: 'Email', translate: true)]
    public $email = '';

    #[Validate('required', as: 'Contraseña', translate: true)] 
    public $password = '';

    public function set()
    {
        $this->fill([
            'email' => '',
            'password' => ''
        ]);
    }
}
