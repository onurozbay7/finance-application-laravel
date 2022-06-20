<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonelIslemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personel_islems', function (Blueprint $table) {
            $table->id();
            $table->integer('personelId');
            $table->integer('islemTipi')->comment('0 ise avans, 1 ise maaş');
            $table->integer('hesap');
            $table->date('tarih');
            $table->double('tutar');
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
        Schema::dropIfExists('personel_islems');
    }
}
