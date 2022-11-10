<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePayTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_pay_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_pay_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->unique([ 'locale','type_pay_id']);
            $table->foreign('type_pay_id')->references('id')->on('type_pays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_pay_translations');
    }
}
