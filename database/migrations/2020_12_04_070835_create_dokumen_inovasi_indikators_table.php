<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenInovasiIndikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_inovasi_indikators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->text('tentang');
            $table->string('nama_file');
            $table->string('lokasi_file');
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
        Schema::dropIfExists('dokumen_inovasi_indikators');
    }
}
