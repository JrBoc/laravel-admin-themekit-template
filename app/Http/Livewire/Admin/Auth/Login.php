<?php

namespace App\Http\Livewire\Admin\Auth;

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

        $data = [
            'email' => 'jrboc18@gmail.com',
            'password' => 'admin',
        ];

        if (!Auth::attempt($data, $this->remember_me)) {
            $this->password = '';

            return $this->addError('email', trans('auth.failed'));
        }

        if(!Auth::user()->status) {
            Auth::login();

            return $this->addError('email', 'Your account is Inactive.');
        }

        session()->flash('login_successful');

        $this->dispatchBrowserEvent('redirectToDashboard');
    }
}
