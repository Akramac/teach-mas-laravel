<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestLongTextJunction extends Model
{
    use HasFactory;

    protected $table = 'exam_question_long_text';

    protected $fillable = [
        'exam_id',
        'question_long_text_id',
        'created_at',
        'updated_at',
        ];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function questionLongText(){
        return $this->belongsTo(QuestionLongText::class);
    }

}
