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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('no_specific_time');
            $table->string('title', 255);
            $table->string('duration', 255);
            $table->string('option_to_order_1', 255);
            $table->string('option_to_order_2', 255);
            $table->string('option_to_order_3', 255);
            $table->string('option_to_order_4', 255);
            $table->string('option_to_order_5', 255);
            $table->string('option_to_order_6', 255);
            $table->string('file_url', 255);
            $table->integer('points');
            $table->string('image', 255);
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
