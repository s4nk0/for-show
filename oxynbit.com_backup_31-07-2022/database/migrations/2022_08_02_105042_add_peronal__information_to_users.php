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
            $table->string('user_name')->after('name');
            $table->date('date_of_birth')->nullable()->after('email_verified_at');
            $table->string('present_address')->nullable()->after('email_verified_at');
            $table->string('permanent_address')->nullable()->after('email_verified_at');
            $table->string('city')->nullable()->after('email_verified_at');
            $table->string('country')->nullable()->after('email_verified_at');
            $table->bigInteger('postal_code')->nullable()->after('email_verified_at');
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
            $table->dropColumn('date_of_birth');
            $table->dropColumn('present_address');
            $table->dropColumn('permanent_address');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('postal_code');
        });
    }
};
