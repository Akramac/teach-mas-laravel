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
        Schema::create('question_multi_choice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title', 255);
            $table->string('duration', 255);
            $table->boolean('is_single_choice');
            $table->boolean('no_specific_time');
            $table->string('option_1', 255);
            $table->string('correct_option_1', 255);
            $table->string('option_2', 255);
            $table->string('correct_option_2', 255);
            $table->string('option_3', 255);
            $table->string('correct_option_3', 255);
            $table->string('option_4', 255);
            $table->string('correct_option_4', 255);
            $table->string('option_5', 255);
            $table->string('correct_option_5', 255);
            $table->string('option_6', 255);
            $table->string('correct_option_6', 255);
            $table->string('file_url', 255);
            $table->integer('points');
            $table->string('image', 255);
            $table->longText('data_file');
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
        Schema::dropIfExists('question_multi_choice');
    }
};
