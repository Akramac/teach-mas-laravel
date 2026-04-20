<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestSpanJunction extends Model
{
    use HasFactory;

    protected $table = 'exam_question_span';

    protected $fillable = [
        'exam_id',
        'question_span_id',
        'created_at',
        'updated_at',
    ];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function questionSpan(){
        return $this->belongsTo(QuestionSpan::class);
    }
}
