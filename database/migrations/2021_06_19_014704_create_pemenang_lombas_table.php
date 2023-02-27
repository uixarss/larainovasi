<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemenangLombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemenang_lombas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lomba_id');
            $table->unsignedBigInteger('peserta_id');
            $table->integer('urutan');
            $table->string('title');
            $table->string('keterangan')->nullable();
            

            $table->foreign('peserta_id')
            ->references('id')->on('pesertas')
            ->onDelete('cascade');
            $table->foreign('lomba_id')
            ->references('id')->on('lombas')
            ->onDelete('cascade');
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
        Schema::dropIfExists('pemenang_lombas');
    }
}
