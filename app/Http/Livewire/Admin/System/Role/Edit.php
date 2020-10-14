<?php

namespace App\Http\Livewire\Admin\System\Role;

use App\Http\Livewire\LivewireForm;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class Edit extends Component
{
    use LivewireForm;

    public $role;

    public $role_name = '';
    public $permissions = [];

    public $editable = false;

    public function render()
    {
        return view('livewire.admin.system.role.edit', [
            'stored_permissions' => Permission::query()->orderBy('name', 'asc')->get(),
        ]);
    }

    public function get(Role $role, $editable = false)
    {
        $this->role = $role;

        $this->role_name = $role->name;

        foreach($role->permissions()->pluck('id')->toArray() as $p) {
            $this->permissions[] = (string) $p;
        }

        $this->editable = $editable;

        $this->emit('openModal', [
            'id' => '#mdl_edit',
            'title' => $this->editable ? 'Edit Role' : 'View Role'
        ]);
    }

    public function update()
    {
        $this->validate_attributes = [
            'role_name' => 'role'
        ];

        $this->validate([
            'role_name' => 'required|string|unique:sys_roles,name,' . $this->role->id,
            'permissions' => 'required|array',
        ]);

        $this->role->update([
            'name' => $this->role_name,
        ]);

        if($this->permissions) {
            $this->role->syncPermissions($this->permissions);
        }

        $this->emit('tableRefresh');

        $this->emit('closeModal', [
            'id' => '#mdl_edit',
        ]);

        $this->emit('msg', [
            'message' => 'Role updated.'
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        $this->emit('tableRefresh');

        $this->emit('msg', [
            'message' => 'Role deleted.'
        ]);
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
    }
}
