<?php

namespace App\Http\Livewire\Admin\System\Permission;

use App\Http\Livewire\LivewireForm;
use App\Models\Permission;
use Livewire\Component;

class Create extends Component
{
    use LivewireForm;

    public $permission = '';
    public $module = '';

    public function render()
    {
        return view('livewire.admin.system.permission.create');
    }

    public function create()
    {
        $this->validate([
            'permission' => 'required|string',
            'module' => 'required|string',
        ]);

        $name = str_replace(' ','_',(strtolower($this->module))) . '.' . str_replace(' ','_',(strtolower($this->permission)));

        if(Permission::query()->where('name', $name)->count()) {
            $this->emit('closeDialogBox');

            return $this->addError('permission', 'Permission already exists for this Module.');
        }

        Permission::create([
            'name' => $name,
            'guard' => 'web',
        ]);

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
