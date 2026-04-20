<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestTartibJunction extends Model
{
    use HasFactory;

    protected $table = 'exam_question_tartib';

    protected $fillable = [
        'exam_id',
        'question_tartib_id',
        'created_at',
        'updated_at',
    ];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function questionTartib(){
        return $this->belongsTo(QuestionTartib::class);
    }
}
