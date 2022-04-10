<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odemes', function (Blueprint $table) {
            $table->id();
            $table->integer('tip')->default(0); // 0 ise ödeme 1 ise tahsilat.
            $table->integer('musteriId');
            $table->integer('faturaId')->default(0);
            $table->double('fiyat');
            $table->date('tarih');
            $table->integer('bankaId');
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
        Schema::dropIfExists('odemes');
    }
}
