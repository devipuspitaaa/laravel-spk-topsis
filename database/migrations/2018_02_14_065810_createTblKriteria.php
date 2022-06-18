<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblKriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdKriteria',15)->nullable();
            $table->string('nmKriteria',50)->nullable();
            $table->text('ket')->nullable();
            $table->integer('bobot')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblKriteria');
    }
}
