<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignerProjectProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designer_project_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('designer_projects_id')->unsigned();
            $table->integer('product_id')->unsigned();


            $table->foreign('designer_projects_id')->references('id')->on('designer_projects')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products_new')->onDelete('cascade');
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
        Schema::dropIfExists('designer_project_product');
    }
}
