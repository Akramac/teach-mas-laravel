<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTartib extends Model
{
    use HasFactory;

    protected $table = 'question_tartib';

    protected $fillable = [
        'user_id',
        'no_specific_time',
        'title',
        'duration',
        'option_to_order_1',
        'option_to_order_2',
        'option_to_order_3',
        'option_to_order_4',
        'option_to_order_5',
        'option_to_order_6',
        'file_url',
        'points',
        'image',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question_tartib');
    }

}
