<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Permission extends Model
{
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
