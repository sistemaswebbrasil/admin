<?php

namespace App\Model;

use Laratrust\LaratrustRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends LaratrustRole
{
    use Notifiable;
    protected $fillable = [
        'name', 'display_name'
    ]; 

    public function permissions(){        
         return $this->belongsToMany('App\Model\Permission');         
    }   

    public function users(){        
        return $this->belongsToMany('App\User');         
    }

    public function getPermissionListAttribute()
    {
        return $this->permissions->pluck('id','name')->toArray();
    }    
}
