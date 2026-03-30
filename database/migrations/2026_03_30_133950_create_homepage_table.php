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
        Schema::create('homepage', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('image_1', 255);
            $table->string('image_2', 255);
            $table->string('image_3', 255);
            $table->string('image_4', 255);
            $table->string('image_5', 255);
            $table->string('image_6', 255);
            $table->string('image_7', 255);
            $table->string('image_8', 255);
            $table->string('image_9', 255);
            $table->string('image_10', 255);
            $table->string('image_11', 255);
            $table->string('image_12', 255);
            $table->string('url', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homepage');
    }
};
