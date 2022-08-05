<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryWarmupItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_warmup_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warmup_id');
            $table->unsignedBigInteger('story_id');
            $table->timestamps();

            $table->foreign('warmup_id')->references('id')->on('warmups')->onDelete('cascade');
            $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_warmup_items');
    }
}
