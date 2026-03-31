<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseQuestionMultiChoice extends Model
{
    use HasFactory;

    protected $table = 'response_question_mutli_choice';

    protected $fillable = [
        'user_id',
        'teacher_id',
        'student_id',
        'question_multi_id',
        'exam_id',
        'title',
        'is_single_choice',
        'response_option_1',
        'response_option_2',
        'response_option_3',
        'response_option_4',
        'response_option_5',
        'response_option_6',
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
    public function questionMultiChoice(){
        return $this->belongsTo(QuestionMultiChoice::class);
    }
}
