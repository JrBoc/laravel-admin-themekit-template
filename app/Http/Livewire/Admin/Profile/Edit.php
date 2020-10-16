<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Http\Livewire\LivewireForm;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    use LivewireForm;

    public $name = '';
    public $email = '';
    public $editable = false;

    public function render()
    {
        return view('livewire.admin.profile.edit');
    }

    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sys_users,email,' . auth()->id(),
        ]);

        $this->editable = false;

        auth()->user()->update([
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
        $this->mount();
    }
}
