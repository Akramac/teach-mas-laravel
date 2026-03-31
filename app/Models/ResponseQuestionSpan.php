<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseQuestionSpan extends Model
{
    use HasFactory;

    protected $table = 'response_question_span';

    protected $fillable = [
        'user_id',
        'teacher_id',
        'student_id',
        'exam_id',
        'question_span_id',
        'reponse_span',
        'correct_span',
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
    public function questionSpan(){
        return $this->belongsTo(QuestionSpan::class);
    }
}
