<?php

namespace App\Http\Livewire\Admin\System\User;

use App\Http\Livewire\LivewireForm;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    use LivewireForm;

    public $name = '';
    public $email = '';
    public $roles = [];
    public $password = '';
    public $password_confirmation = '';
    public $status = 1;

    public function render()
    {
        return view('livewire.admin.system.user.create', [
            'stored_roles' => Role::all(),
        ]);
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sys_users',
            'password' => 'required|string|min:8|max:30|confirmed',
            'roles' => 'required|array',
            'status' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => $this->status,
        ]);

        $user->syncRoles($this->roles);

        $this->clear();

        $this->emit('tableRefresh');

        $this->emit('closeModal', [
            'id' => '#mdl_create',
        ]);

        $this->emit('msg', [
            'message' => 'User created'
        ]);
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
    }
}
