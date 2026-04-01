<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionLongText extends Model
{
    use HasFactory;

    protected $table = 'question_long_text';

    protected $fillable = [
        'user_id',
        'no_specific_time',
        'title',
        'correct_long_text',
        'duration',
        'file_url',
        'points',
        'image',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function responseQuestionLongs(){
        return $this->hasMany(ResponseQuestionLongText::class);
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question_long_text');
    }
}
