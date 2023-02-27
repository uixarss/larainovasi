<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInovasiDaerahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inovasi_daerahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_inovasi');
            $table->string('nama_sub_keg')->nullable();
            $table->integer('kd_sub_keg')->nullable();
            $table->string('nama_keg')->nullable();
            $table->integer('kd_keg')->nullable();
            $table->string('nama_prg')->nullable();
            $table->integer('kd_prg')->nullable();
            $table->enum('tahapan_inovasi',['Inisiatif','Uji Coba','Penerapan']);
            $table->enum('inisiator_inovasi',['Kepala Daerah','Anggota DPRD','OPD','ASN','Masyarakat']);
            $table->enum('jenis_inovasi',['digital','non digital']);
            $table->text('bentuk_inovasi')->nullable();
            $table->string('urusan_inovasi');
            $table->date('waktu_uji_coba');
            $table->date('waktu_implementasi');
            $table->text('rancang_inovasi')->nullable();
            $table->text('tujuan_inovasi')->nullable();
            $table->text('manfaat_inovasi')->nullable();
            $table->text('hasil_inovasi')->nullable();
            $table->string('anggaran_inovasi')->nullable();
            $table->string('profil_bisnis')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->foreign('created_by')
            ->references('id')->on('users')
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
        Schema::dropIfExists('inovasi_daerahs');
    }
}
