<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestMultiChoiceJunction extends Model
{
    use HasFactory;

    protected $table = 'exam_question_multi_choice';

    protected $fillable = [
        'exam_id',
        'question_multi_choice_id',
        'created_at',
        'updated_at',
    ];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function questionMultichoice(){
        return $this->belongsTo(QuestionMultiChoice::class);
    }
}
