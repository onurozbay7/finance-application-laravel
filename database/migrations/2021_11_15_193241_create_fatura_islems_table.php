<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturaIslemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatura_islems', function (Blueprint $table) {
            $table->id();
            $table->integer('faturaId');
            $table->integer("urunId")->default(0);
            $table->integer('miktar');
            $table->double('fiyat');
            $table->integer('kdv');
            $table->double('araToplam');
            $table->double('kdvToplam');
            $table->double('genelToplam');
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
        Schema::dropIfExists('fatura_islems');
    }
}
