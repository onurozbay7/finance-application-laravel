<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalems', function (Blueprint $table) {
            $table->id();
            $table->integer('kalemTipi')->default(0); // 0 ise gelir kalemi, 1 ise gider kalemi.
            $table->string('ad');
            $table->string('kdv');
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
        Schema::dropIfExists('kalems');
    }
}
