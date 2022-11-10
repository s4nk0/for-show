<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeDeliveryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_delivery_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_delivery_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->unique([ 'locale','type_delivery_id']);
            $table->foreign('type_delivery_id')->references('id')->on('type_deliveries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_delivery_translations');
    }
}
