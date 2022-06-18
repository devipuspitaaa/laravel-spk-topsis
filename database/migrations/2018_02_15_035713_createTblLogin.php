<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblLogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbllogin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama',50)->nullable();
            $table->string('pengguna',50)->nullable();
            $table->string('sandi',50);
            $table->string('akses',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbllogin');
    }
}
