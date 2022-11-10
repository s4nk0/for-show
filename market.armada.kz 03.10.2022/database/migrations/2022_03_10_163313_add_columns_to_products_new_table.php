<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_new', function (Blueprint $table) {
            $table->boolean('is_price_none')->default(false);
            $table->boolean('is_price_from')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_new', function (Blueprint $table) {
//            $table->dropColumn('is_price_none');
            $table->dropColumn('is_price_from');
//            $table->dropColumn('price_to');
        });
    }
}
