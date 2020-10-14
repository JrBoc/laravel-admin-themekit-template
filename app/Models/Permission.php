<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $appends = [
        'module',
        'permission',
        'module_permission',
    ];

    public function getModuleAttribute()
    {
        return ucwords(str_replace('_', ' ', explode('.', $this->name)[0]));
    }

    public function getPermissionAttribute()
    {
        return ucwords(str_replace('_', ' ', explode('.', $this->name)[1]));
    }

    public function getModulePermissionAttribute()
    {
        return $this->module . ' - ' . $this->permission;
    }
}
