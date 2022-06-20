<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKapiOlculerisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kapi_olculeris', function (Blueprint $table) {
            $table->id();
            $table->integer('urunId');
            $table->string('boy');
            $table->string('en');
            $table->string('kasa');
            $table->integer('adet');
            $table->string('kenar')->nullable();
            $table->string('model')->nullable();
            $table->string('renk')->nullable();
            $table->string('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kapi_olculeris');
    }
}
