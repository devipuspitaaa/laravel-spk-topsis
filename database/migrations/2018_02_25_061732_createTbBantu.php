<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbBantu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblbantu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penilaianId')->nullable();
            $table->string('bnMesin')->nullable();
            $table->string('bnBody')->nullable();
            $table->string('bnTahun')->nullable();
            $table->string('bnHarga')->nullable();
            $table->integer('status')->nullable();
            $table->double('positif')->default(0);
            $table->double('negatif')->default(0);
            $table->double('topsis')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblbantu');
    }
}
