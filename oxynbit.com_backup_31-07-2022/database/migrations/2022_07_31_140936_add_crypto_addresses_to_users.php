<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('btc_address')->nullable()->after('btc_wallet_id_hash');
            $table->string('eth_address')->nullable()->after('eth_wallet_id');
            $table->string('ltc_address')->nullable()->after('ltc_wallet_id_hash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('btc_address');
            $table->dropColumn('eth_address');
            $table->dropColumn('ltc_address');
        });
    }
};
