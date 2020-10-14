<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Http\Livewire\LivewireForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember_me = false;

    public function render()
    {
        return view('livewire.admin.auth.login');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember_me' => 'nullable|boolean',
        ]);

        $data = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (!Auth::attempt($data, $this->remember_me)) {
            return $this->addError('email', trans('auth.failed'));
        }

        return redirect()->intended(route('admin.dashboard'));
    }
}
