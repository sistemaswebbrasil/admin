<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use Notifiable;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name', 'display_name', 'created_at', 'updated_at', 'description',
    ];

    public function permissions()
    {
        return $this->belongsToMany('App\Model\Permission');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function getPermissionListAttribute()
    {
        return $this->permissions->pluck('id', 'name')->toArray();
    }
}
