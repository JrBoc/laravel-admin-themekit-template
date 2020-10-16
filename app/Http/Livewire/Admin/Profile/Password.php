<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Http\Livewire\LivewireForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Password extends Component
{
    use LivewireForm;

    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';
    public $editable = false;

    public function render()
    {
        return view('livewire.admin.profile.password');
    }

    public function update()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|max:30|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->emit('closeDialogBox');

            return $this->addError('current_password', 'Current password does not match.');
        }

        if (Hash::check($this->new_password, $user->password)) {
            $this->emit('closeDialogBox');

            return $this->addError('new_password', 'Please enter a new password. You cannot use existing password.');
        }

        $this->editable = false;

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->clear();

        $this->emit('msg', [
            'message' => 'Password updated.'
        ]);
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
    }
}
