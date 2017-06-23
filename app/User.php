<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Log;


class User extends Authenticatable
{
    use LaratrustUserTrait;    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){        
         return $this->belongsToMany('App\Model\Role');         
    }   

    public function permissions()
    {
        return $this->belongsToMany('App\Model\Permission');
    }

    public function getRoleListAttribute()
    {
        return $this->roles->pluck('id','name')->toArray();
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
