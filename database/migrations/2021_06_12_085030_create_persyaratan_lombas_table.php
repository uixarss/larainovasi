<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersyaratanLombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persyaratan_lombas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lomba_id');
            $table->integer('urutan')->nullable();
            $table->text('name');
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable(); //active, inactive
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
        Schema::dropIfExists('persyaratan_lombas');
    }
}
