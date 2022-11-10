<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcatalogTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcatalog_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('subcatalog_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->string('h1');
            $table->unique([ 'locale','subcatalog_id']);
            $table->foreign('subcatalog_id')->references('id')->on('subcatalogs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcatalog_translations');
    }
}
