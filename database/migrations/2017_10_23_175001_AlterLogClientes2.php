<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLogClientes2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suporte_log_erros_clientes', function (Blueprint $table) {
            $table->char('lido')->default('');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suporte_log_erros_clientes', function (Blueprint $table) {
            $table->dropColumn('lido');
        });
    }
}
