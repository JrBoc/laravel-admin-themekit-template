<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'sys_users';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'html_status',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'sys_user_roles');
    }

    public function getHtmlStatusAttribute()
    {
        return [
            0 => '<label class="badge badge-secondary mb-0">Inactive</label>',
            1 => '<label class="badge badge-success mb-0">Active</label>'
        ][$this->status] ?? '<label class="badge badge-danger mb-0">Unknown Status: '. $this->status .'</label>';
    }

}
