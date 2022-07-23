<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarmupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warmups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('sort')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warmups');
    }
}
