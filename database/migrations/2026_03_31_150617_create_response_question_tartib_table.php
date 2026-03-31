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
        Schema::create('response_question_tartib', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_tartib_id')->constrained()->onDelete('cascade');
            $table->string('reponse_option_to_order_1', 255);
            $table->string('correct_order_1', 255);
            $table->string('reponse_option_to_order_2', 255);
            $table->string('correct_order_2', 255);
            $table->string('reponse_option_to_order_3', 255);
            $table->string('correct_order_3', 255);
            $table->string('reponse_option_to_order_4', 255);
            $table->string('correct_order_4', 255);
            $table->string('reponse_option_to_order_5', 255);
            $table->string('correct_order_5', 255);
            $table->string('reponse_option_to_order_6', 255);
            $table->string('correct_order_6', 255);
            $table->integer('note_by_teacher');
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
        Schema::dropIfExists('response_question_tartib');
    }
};
