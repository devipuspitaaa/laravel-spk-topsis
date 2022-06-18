<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblpenilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdPenilaian',10)->nullable();
            $table->integer('motorId')->unsigned();
            $table->string('konMesin',30)->nullable();
            $table->string('konBody',30)->nullable();
            $table->string('thnPakai',5)->nullable();
            $table->double('harga')->nullable();
            $table->double('nilTopsis')->default(0);

            $table->foreign('motorId')->references('id')->on('tblmotor')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblpenilaian');
    }
}
