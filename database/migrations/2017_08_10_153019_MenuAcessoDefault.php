<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuAcessoDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menuacesso', function (Blueprint $table) {
            $table->string('permission')->default(' ')->change();
            $table->string('url')->default(' ')->change();
            $table->string('icon')->default(' ')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menuacesso', function (Blueprint $table) {
            $table->dropColumn('permission');
            $table->dropColumn('url');
            $table->dropColumn('icon');
        });
    }
}
