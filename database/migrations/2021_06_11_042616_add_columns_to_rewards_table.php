<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rewards', function (Blueprint $table) {
            $table->string('kd_dana')->nullable()
            ->after('id_inovasi');
            $table->string('urut_dana')->nullable()
            ->after('id_inovasi');
            $table->string('nama_dana')->nullable()
            ->after('id_inovasi');
            $table->string('tipe')->nullable()
            ->after('id_inovasi');
            $table->string('tahun')->nullable()
            ->after('id_inovasi');
            $table->string('keterangan')->nullable()
            ->after('id_inovasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rewards', function (Blueprint $table) {
            //
        });
    }
}
