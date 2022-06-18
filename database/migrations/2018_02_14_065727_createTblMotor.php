<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMotor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblMotor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdMotor',15)->nullable();
            $table->string('jnsMotor',25)->nullable();
            $table->string('merkMotor',200)->nullable();
            $table->string('thnMotor',4)->nullable();
            $table->string('noMesin',100)->nullable();
            $table->text('foto')->nullable();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblMotor');
    }
}
