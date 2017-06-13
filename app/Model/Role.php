<?php

namespace App\Model;

use Laratrust\LaratrustRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Role extends LaratrustRole
{
    use LaratrustUserTrait;    
    use Notifiable;
    protected $fillable = [
        'name', 'display_name',
    ]; 

    public function permissions(){        
         return $this->belongsToMany('App\Model\Permission');
         //return $this->belongsToMany('App\Model\Permission', 'permissions');
    }   
}
