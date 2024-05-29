<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $user;

    public function mount()
    {
        $this->user->set();
    }

    public function render()
    {
        return view('livewire.login')
            ->layout('components.layouts.auth', []);
    }

    public function loginin()
    {
        $validatedData = $this->validate(null, [], [
            'email' => __('Email'),
            'password' => __('Password'),
        ]);

        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            return redirect()->intended('/admin');
        } else {
            $this->addError('user.email', 'Wrong credentials');
        }
    }
}
