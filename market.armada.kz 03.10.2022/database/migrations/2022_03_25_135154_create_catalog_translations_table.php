<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('catalog_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->string('h1');
            $table->string('menu_title');
            $table->unique([ 'locale','catalog_id']);
            $table->foreign('catalog_id')->references('id')->on('catalogs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_translations');
    }
}
