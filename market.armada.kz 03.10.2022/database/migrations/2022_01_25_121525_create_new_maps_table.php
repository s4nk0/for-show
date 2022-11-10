<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_maps', function (Blueprint $table) {
            $table->unsignedInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores_new')->onDelete('cascade');
            $table->string('map_polygon_id')->unique();
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
        Schema::dropIfExists('new_maps');
    }
}
