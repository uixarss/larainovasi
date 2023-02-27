<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->longText('body');
            $table->string('nama_file')->nullable();
            $table->string('lokasi_file')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('name')->nullable();
            $table->string('status')->nullable(); // pending, process, selesai
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
        Schema::dropIfExists('pengaduans');
    }
}
