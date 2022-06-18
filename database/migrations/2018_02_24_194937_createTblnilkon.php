<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblnilkon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblnilaikon', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penilaianId')->unsigned();
            $table->string('konMesinKon',30)->nullable();
            $table->string('konBodyKon',30)->nullable();
            $table->string('thnPakaiKon',5)->nullable();
            $table->double('hargaKon')->nullable();

            $table->foreign('penilaianId')->references('id')->on('tblpenilaian')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblnilaikon');
    }
}
