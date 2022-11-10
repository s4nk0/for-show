<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('faq_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->index();
            $table->text('description')->nullable();
            $table->unique([ 'locale','faq_id']);
            $table->foreign('faq_id')->references('id')->on('faqs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_translations');
    }
}
