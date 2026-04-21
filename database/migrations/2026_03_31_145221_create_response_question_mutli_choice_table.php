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
        Schema::create('response_question_mutli_choice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->foreignId('question_multi_id')->constrained('question_multi_choice','id')->onDelete('cascade');
            $table->string('title', 255)->nullable();
            $table->boolean('is_single_choice')->nullable();
            $table->string('response_option_1', 255)->nullable();
            $table->string('response_option_2', 255)->nullable();
            $table->string('response_option_3', 255)->nullable();
            $table->string('response_option_4', 255)->nullable();
            $table->string('response_option_5', 255)->nullable();
            $table->string('response_option_6', 255)->nullable();
            $table->integer('note_by_teacher')->nullable();
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
        Schema::dropIfExists('response_question_mutli_choice');
    }
};
