<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseQuestionTawsil extends Model
{
    use HasFactory;

    protected $table = 'response_question_tawsil';

    protected $fillable = [
        'user_id',
        'teacher_id',
        'student_id',
        'question_tawsil_id',
        'exam_id',
        'response_option_1',
        'correct_option_1',
        'response_option_2',
        'correct_option_2',
        'response_option_3',
        'correct_option_3',
        'response_option_4',
        'correct_option_4',
        'response_option_5',
        'correct_option_5',
        'response_option_6',
        'correct_option_6',
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
    public function questionTawsil(){
        return $this->belongsTo(QuestionTawsil::class);
    }
}
