<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiIndikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_indikators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('indikator_id');
            $table->text('uraian');
            $table->integer('nilai');

            $table->foreign('indikator_id')
            ->references('id')->on('indikators')
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
        Schema::dropIfExists('nilai_indikators');
    }
}
