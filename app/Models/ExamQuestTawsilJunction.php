<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestTawsilJunction extends Model
{
    use HasFactory;

    protected $table = 'exam_question_tawsil';

    protected $fillable = [
        'exam_id',
        'question_tawsil_id',
        'created_at',
        'updated_at',
    ];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function questionTawsil(){
        return $this->belongsTo(QuestionTawsil::class);
    }
}
