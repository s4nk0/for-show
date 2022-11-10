<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesToFulltext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('fulltext', function (Blueprint $table) {
//            //
//        });
        DB::statement('ALTER TABLE `products_new` ADD FULLTEXT INDEX products_title_index (title)');
        DB::statement('ALTER TABLE `catalogs` ADD FULLTEXT INDEX catalogs_title_index (title)');
        DB::statement('ALTER TABLE `items` ADD FULLTEXT INDEX items_title_index (title)');
        DB::statement('ALTER TABLE `subcatalogs` ADD FULLTEXT INDEX subcatalogs_title_index (title)');
        DB::statement('ALTER TABLE `stores_new` ADD FULLTEXT INDEX stores_title_index (title)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

            Schema::table('products_new', function($table) {
                $table->dropIndex('products_title_index');
            });
            Schema::table('catalogs', function($table) {
                $table->dropIndex('catalogs_title_index');
            });
            Schema::table('items', function($table) {
                $table->dropIndex('items_title_index');
            });
            Schema::table('subcatalogs', function($table) {
                $table->dropIndex('subcatalogs_title_index');
            });
            Schema::table('stores_new', function($table) {
                $table->dropIndex('stores_title_index');
            });

    }
}
