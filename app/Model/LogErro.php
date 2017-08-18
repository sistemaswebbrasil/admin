<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LogErro extends Model
{
    protected $table = 'suporte_log_erros_clientes';

    protected $dates = [
        'data',
    ];
}
