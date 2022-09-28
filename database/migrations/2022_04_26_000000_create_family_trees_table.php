<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_trees', function (Blueprint $table) {
              // $table->id();
            // $table->string('first_name')->nullable();
            // $table->string('last_name')->nullable();
            // $table->date('dob')->nullable();
            // $table->unsignedBigInteger('relation_id')->nullable();
            // $table->foreign('relation_id')
            //     ->references('id')
            //     ->on('relations')
            //     ->onDelete('cascade');
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade');
            // $table->unsignedBigInteger('admin_id')->nullable();
            // $table->string('gender', 50)->nullable();
            // $table->tinyInteger('connect_with')->nullable();
            // $table->timestamps();
            // $table->softDeletes();

            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('gender', 50)->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pid')->nullable();
            $table->unsignedBigInteger('fid')->nullable();
            $table->unsignedBigInteger('mid')->nullable();
            $table->tinyInteger('status')->default(1);
            
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
        Schema::dropIfExists('family_trees');
    }
}
