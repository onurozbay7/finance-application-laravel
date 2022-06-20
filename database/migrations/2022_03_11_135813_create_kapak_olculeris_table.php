<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKapakOlculerisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kapak_olculeris', function (Blueprint $table) {
            $table->id();
            $table->integer("urunId");
            $table->string('boy');
            $table->string('en');
            $table->integer('adet');
            $table->string('model')->nullable();
            $table->string('tac')->nullable();
            $table->string('parca')->nullable();
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
        Schema::dropIfExists('kapak_olculeris');
    }
}
