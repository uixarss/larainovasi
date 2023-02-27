<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penelitians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->longText('abstract');
            $table->longText('description');
            $table->text('keyword');
            $table->string('author');
            $table->text('institution');
            $table->enum('status',['draft','publish','review']);
            $table->string('file_name_full_article');
            $table->string('loc_file_name_full_article');
            $table->integer('upload_by');
            $table->integer('publish_by')->nullable();
            $table->timestamp('publish_at')->nullable();
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
        Schema::dropIfExists('penelitians');
    }
}
