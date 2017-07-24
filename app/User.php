<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // //public function getCreatedAtAttribute($date)
    // public function getUpdatedAtttribute($date)
    // {
    //     return new Date($date);
    // }

    // public function getCreatedAtAtttribute($date)
    // {
    //     return new Date($date);
    // }

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
        return $this->roles->pluck('id', 'name')->toArray();
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
