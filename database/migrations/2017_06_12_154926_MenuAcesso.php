<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuAcesso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('menuacesso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->string('url');
            $table->string('icon')->default('');
            $table->string('label')->default('');
            $table->string('label_color')->default('');
            $table->string('permission')->default('');
            $table->string('target')->default('');
            $table->string('parent')->default(0);
            $table->timestamps();
        });        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menuacesso');
    }
}


