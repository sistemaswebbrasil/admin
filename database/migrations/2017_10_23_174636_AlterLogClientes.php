<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLogClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suporte_log_erros_clientes', function (Blueprint $table) {
            $table->string('cl_nome')->default('')->after('cl_codigo');           
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
            $table->dropColumn('cl_nome');
        });
    }
}