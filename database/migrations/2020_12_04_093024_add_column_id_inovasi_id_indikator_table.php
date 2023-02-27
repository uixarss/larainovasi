<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdInovasiIdIndikatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('dokumen_inovasi_indikators', function (Blueprint $table) {
            $table->unsignedBigInteger('inovasi_id')
            ->after('id');
            $table->unsignedBigInteger('indikator_id')
            ->after('id');

            $table->foreign('indikator_id')
            ->references('id')->on('indikators')
            ->onDelete('cascade');

            $table->foreign('inovasi_id')
            ->references('id')->on('inovasi_daerahs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
