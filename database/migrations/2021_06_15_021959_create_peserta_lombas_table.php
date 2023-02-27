<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaLombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_lombas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('peserta_id');
            $table->unsignedBigInteger('lomba_id');
            $table->string('kode_peserta')->unique()->nullable();
            $table->text('judul_dokumen_lomba')->nullable();
            $table->string('nama_dokumen_lomba')->nullable();
            $table->string('lokasi_dokumen_lomba')->nullable();

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
        Schema::dropIfExists('peserta_lombas');
    }
}
