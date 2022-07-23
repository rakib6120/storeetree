<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpouseIdFieldToFamilyTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family_trees', function (Blueprint $table) {
            $table->unsignedBigInteger('spouse_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('family_trees', function (Blueprint $table) {
            $table->dropColumn('spouse_id');
            $table->dropColumn('parent_id');
        });
    }
}
