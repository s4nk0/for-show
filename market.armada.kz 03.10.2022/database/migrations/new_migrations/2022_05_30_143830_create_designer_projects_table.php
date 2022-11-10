<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignerProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designer_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type_object')->nullable();
            $table->string('size')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('visual');
            $table->string('images')->nullable();
            $table->string('address')->nullable();
            $table->string('slug');
            $table->text('description');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('designer_style_id')->references('id')
                ->on('designer_styles')->onDelete('cascade');
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
        Schema::dropIfExists('designer_projects');
    }
}
