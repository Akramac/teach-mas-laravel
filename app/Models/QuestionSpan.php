<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSpan extends Model
{
    use HasFactory;

    protected $table = 'question_span';

    protected $fillable = [
        'user_id',
        'no_specific_time',
        'title',
        'span_text',
        'words',
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
    public function responseQuestionSpan(){
        return $this->hasMany(ResponseQuestionSpan::class);
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question_span');
    }
}
