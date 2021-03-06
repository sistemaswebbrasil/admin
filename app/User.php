<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'language', 'skin', 'created_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Model\Permission');
    }

    public function getRoleListAttribute()
    {
        return $this->roles->pluck('name')->toArray();
    }
    public function getPermissionListAttribute()
    {
        $roles = $this->Roles()->get();
        foreach ($roles as $role) {
            $permissoes = $role->permissions->pluck('name')->toArray();
            return $permissoes;
        }
    }
}
