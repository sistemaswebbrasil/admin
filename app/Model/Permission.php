<?php

namespace App\Model;

use Laratrust\LaratrustPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Permission extends LaratrustPermission
{
    use LaratrustUserTrait;    
    use Notifiable;
    protected $fillable = [
        'name', 'display_name',
    ]; 
   

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role');        
    }


}
