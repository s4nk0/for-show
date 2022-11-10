<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DesignerInfoStyleTableManyToMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designer_info_designer_style', function (Blueprint $table) {
            $table->foreignId('designer_style_id')->references('id')
                ->on('designer_styles')->onDelete('cascade');
            $table->foreignId('designer_info_id')->references('id')
                ->on('designer_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designer_style_designer_project');
    }
}
