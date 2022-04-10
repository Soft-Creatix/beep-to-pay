<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->unique()->nullable();
            $table->string('identity_card')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('card_pin')->default("0")->nullable();
            $table->string('is_verified')->default("0")->nullable();
            $table->string('phone_otp')->nullable();
            $table->dateTime('otp_datetime')->nullable();
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
            $table->dropColumn('phone_number');
            $table->dropColumn('identity_card');
            $table->dropColumn('dob');
            $table->dropColumn('gender');
            $table->dropColumn('is_verified');
            $table->dropColumn('phone_otp');
            $table->dropColumn('otp_datetime');
        });
    }
}
