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
        Schema::create('question_tartib', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->boolean('no_specific_time')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('duration', 255)->nullable();
            $table->string('option_to_order_1', 255)->nullable();
            $table->string('option_to_order_2', 255)->nullable();
            $table->string('option_to_order_3', 255)->nullable();
            $table->string('option_to_order_4', 255)->nullable();
            $table->string('option_to_order_5', 255)->nullable();
            $table->string('option_to_order_6', 255)->nullable();
            $table->string('file_url', 255)->nullable();
            $table->integer('points')->nullable();
            $table->string('image', 255)->nullable();
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
        Schema::dropIfExists('question_tartib');
    }
};
