<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\LaratrustPermission;
use Laratrust\Traits\LaratrustUserTrait;

class Permission extends LaratrustPermission
{
    use LaratrustUserTrait;
    use Notifiable;
    protected $fillable = [
        'name', 'display_name', 'created_at', 'updated_at', 'description',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    public function getRoleListAttribute()
    {
        return $this->roles->pluck('id', 'name')->toArray();
    }
}
