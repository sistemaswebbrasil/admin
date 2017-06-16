<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
class MenuAcesso extends Model
{
	protected $table = 'menuacesso';
    use Notifiable;

    protected $fillable = [
        'text', 'url','parent','icon','label','label_color','icon_color','permission','target'
    ];     

}