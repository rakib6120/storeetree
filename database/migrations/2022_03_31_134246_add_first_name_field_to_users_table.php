<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirstNameFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable()->after('id');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
            $table->string('postal_code')->nullable()->after('id');
            $table->date('dob')->nullable()->after('id');
            $table->tinyInteger('connected_period')->nullable()->after('id');
            $table->string('last_name')->nullable()->after('id');
            $table->string('first_name')->nullable()->after('id');
            $table->dropColumn('name');
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
            $table->dropColumn('country_id');
            $table->dropColumn('postal_code');
            $table->dropColumn('dob');
            $table->dropColumn('connected_period');
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
            $table->string('name')->nullable()->after('id');
        });
    }
}
