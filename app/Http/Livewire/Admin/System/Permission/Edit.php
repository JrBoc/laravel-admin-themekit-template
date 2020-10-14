<?php

namespace App\Http\Livewire\Admin\System\Permission;

use App\Models\Permission;
use Livewire\Component;

class Edit extends Component
{
    public $module_permission;

    public $name;
    public $module;
    public $permission;

    public function render()
    {
        return view('livewire.admin.system.permission.edit');
    }

    public function get(Permission $permission)
    {
        $this->module_permission = $permission;

        $this->permission = $permission->permission;
        $this->module = $permission->module;
        $this->name = $permission->name;

        $this->emit('tableRefresh');

        $this->emit('openModal', [
            'id' => '#mdl_edit',
        ]);
    }

    public function update()
    {
        $this->validate([
            'permission' => 'required|string',
            'module' => 'required|string',
        ]);

        $name = str_replace(' ', '_', (strtolower($this->module))) . '.' . str_replace(' ', '_', (strtolower($this->permission)));

        if (Permission::query()->where('name', $name)->count() && $this->name !== $name) {
            $this->emit('closeDialogBox');

            return $this->addError('permission', 'Permission already exists for this Module.');
        }

        $this->module_permission->update([
            'name' => $name,
        ]);

        $this->emit('tableRefresh');

        $this->emit('closeModal', [
            'id' => '#mdl_edit',
        ]);

        $this->emit('msg', [
            'message' => 'Permission updated.'
        ]);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        $this->emit('tableRefresh');

        $this->emit('msg', [
            'message' => 'Permission deleted.'
        ]);
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
    }
}
