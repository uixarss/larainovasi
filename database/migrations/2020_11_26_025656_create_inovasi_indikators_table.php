<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInovasiIndikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inovasi_indikators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('indikator_id');
            $table->unsignedBigInteger('inovasi_id');
            $table->integer('bobot');
            
            $table->foreign('indikator_id')
            ->references('id')->on('indikators')
            ->onDelete('cascade');

            $table->foreign('inovasi_id')
            ->references('id')->on('inovasi_daerahs')
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
        Schema::dropIfExists('inovasi_indikators');
    }
}
