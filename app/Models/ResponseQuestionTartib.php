<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseQuestionTartib extends Model
{
    use HasFactory;

    protected $table = 'response_question_tartib';

    protected $fillable = [
        'user_id',
        'teacher_id',
        'student_id',
        'question_tartib_id',
        'exam_id',
        'reponse_option_to_order_1',
        'correct_order_1',
        'reponse_option_to_order_2',
        'correct_order_2',
        'reponse_option_to_order_3',
        'correct_order_3',
        'reponse_option_to_order_4',
        'correct_order_4',
        'reponse_option_to_order_5',
        'correct_order_5',
        'reponse_option_to_order_6',
        'correct_order_6',
        'note_by_teacher',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function questionTartib(){
        return $this->belongsTo(QuestionTartib::class);
    }
}
