<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Http\Livewire\LivewireForm;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    use LivewireForm;

    public $user;
    public $name = '';
    public $email = '';
    public $editable = false;

    public function render()
    {
        $this->get(User::find(auth()->id()));

        return view('livewire.admin.profile.edit');
    }

    public function get(User $user) {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sys_users,email,' . $this->user->id,
        ]);

        $this->editable = false;

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->emit('msg', [
            'message' => 'Profile updated.'
        ]);
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->get(User::find(auth()->id()));
    }
}
