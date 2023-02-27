<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsJenisFileDataPendukungToIndikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indikators', function (Blueprint $table) {

            $table->string('jenis_file')->nullable()
            ->after('keterangan');
            $table->string('data_pendukung')->nullable()
            ->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indikators', function (Blueprint $table) {
            //
        });
    }
}
