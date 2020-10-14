<?php

namespace App\Http\Livewire\Admin\System\User;

use App\Http\Livewire\LivewireForm;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    use LivewireForm;

    public $user;

    public $email = '';
    public $name = '';
    public $roles = [];
    public $status = 1;

    public $editable = false;

    public function render()
    {
        return view('livewire.admin.system.user.edit', [
            'stored_roles' => Role::all(),
        ]);
    }

    public function get(User $user, $editable = false)
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->status = $user->status;

        foreach($user->roles()->pluck('role_id')->toArray() as $p) {
            $this->roles[] = (string) $p;
        }

        $this->editable = $editable;

        $this->emit('openModal', [
            'id' => '#mdl_edit',
            'title' => $this->editable ? 'Edit User' : 'View User'
        ]);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sys_users,email,' . $this->user->id,
            'roles' => 'required|array',
            'status' => 'required|boolean',
        ]);

        $this->editable = false;

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
        ]);

        $this->user->syncRoles($this->roles);

        $this->emit('tableRefresh');

        $this->emit('closeModal', [
            'id' => '#mdl_edit',
        ]);

        $this->emit('msg', [
            'message' => 'User updated.'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        $this->emit('tableRefresh');

        $this->emit('msg', [
            'message' => 'User deleted.'
        ]);
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
    }
}
