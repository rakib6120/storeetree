<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoryStepFieldToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('story_first_step')->nullable();
            $table->string('story_second_step')->nullable();
            $table->string('story_third_step')->nullable();
            $table->string('story_fourth_step')->nullable();
            $table->string('story_fifth_step')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('story_first_step');
            $table->dropColumn('story_second_step');
            $table->dropColumn('story_third_step');
            $table->dropColumn('story_fourth_step');
            $table->dropColumn('story_fifth_step');
        });
    }
}
