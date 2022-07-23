<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationIdFieldToFamilyTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family_trees', function (Blueprint $table) {
            $table->dropForeign(['relation_id']);
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
            $table->foreign('relation_id')
                ->references('id')
                ->on('relations')
                ->onDelete('cascade');
        });
    }
}
