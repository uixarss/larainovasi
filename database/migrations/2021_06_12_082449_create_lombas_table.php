<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lombas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->unsignedBigInteger('jenis_lomba_id');
            $table->dateTime('mulai_acara')->nullable();
            $table->dateTime('selesai_acara')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->dateTime('mulai_daftar')->nullable();
            $table->dateTime('selesai_daftar')->nullable();
            $table->decimal('target_peserta', 11,2)->nullable();
            $table->string('nama_thumbnail')->nullable();
            $table->string('lokasi_thumbnail')->nullable();
            $table->text('lokasi_acara')->nullable();
            $table->text('deskripsi_acara')->nullable();
            $table->string('file_mekanisme')->nullable();
            $table->string('lokasi_file_mekanisme')->nullable();
            $table->string('status')->nullable(); //active, closed, finished
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
        Schema::dropIfExists('lombas');
    }
}
