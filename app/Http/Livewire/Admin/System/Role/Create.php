<?php

namespace App\Http\Livewire\Admin\System\Role;

use App\Http\Livewire\LivewireForm;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class Create extends Component
{
    use LivewireForm;

    public $role = '';
    public $permissions = [];

    public function render()
    {
        return view('livewire.admin.system.role.create', [
            'stored_permissions' => Permission::query()->orderBy('name', 'asc')->get()
        ]);
    }

    public function create()
    {
        $this->validate([
            'role' => 'required|unique:sys_roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create([
            'name' =>  $this->role,
        ]);

        $role->syncPermissions($this->permissions);

        $this->clear();

        $this->emit('tableRefresh');

        $this->emit('closeModal', [
            'id' => '#mdl_create',
        ]);

        $this->emit('msg', [
            'message' => 'Permission created'
        ]);
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
    }
}
