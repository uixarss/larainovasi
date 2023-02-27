<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOpdesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opdes', function (Blueprint $table) {
            $table->integer('kd_unit')->nullable()
            ->after('id');
            $table->integer('kd_bid_urusan')->nullable()
            ->after('name');
            $table->string('urut_bid_urusan')->nullable()
            ->after('name');
            $table->string('nama_bid_urusan')->nullable()
            ->after('name');
            $table->string('urut_unit')->nullable()
            ->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opdes', function (Blueprint $table) {
            //
        });
    }
}
