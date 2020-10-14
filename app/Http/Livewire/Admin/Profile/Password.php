<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Http\Livewire\LivewireForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Password extends Component
{
    use LivewireForm;

    public $user;
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';
    public $editable = false;

    public function render()
    {
        $this->get(User::find(auth()->id()));

        return view('livewire.admin.profile.password');
    }

    public function update()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|max:30|confirmed',
        ]);

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->emit('closeDialogBox');

            return $this->addError('current_password', 'Current password does not match.');
        }

        if (Hash::check($this->new_password, $this->user->password)) {
            $this->emit('closeDialogBox');

            return $this->addError('new_password', 'Please enter a new password. You cannot use existing password.');
        }

        $this->editable = false;

        $this->user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->clear();

        $this->emit('msg', [
            'message' => 'Password updated.'
        ]);
    }

    public function get(User $user)
    {
        $this->user = $user;
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->get(User::find(auth()->id()));
    }
}
