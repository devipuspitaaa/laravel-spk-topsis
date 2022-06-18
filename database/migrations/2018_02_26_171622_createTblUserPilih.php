<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUserPilih extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblpiluser', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nmUser',100)->nullable();
            $table->date('tgl')->nullable();
            $table->text('pilUser')->nullable();
            $table->integer('penilaianId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblpiluser');
    }
}
