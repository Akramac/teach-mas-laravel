<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionMultiChoice extends Model
{
    use HasFactory;

    protected $table = 'question_multi_choice';

    protected $fillable = [
        'user_id',
        'title',
        'duration',
        'is_single_choice',
        'no_specific_time',
        'option_1',
        'correct_option_1',
        'option_2',
        'correct_option_2',
        'option_3',
        'correct_option_3',
        'option_4',
        'correct_option_4',
        'option_5',
        'correct_option_5',
        'option_6',
        'correct_option_6',
        'file_url',
        'points',
        'image',
        'data_file',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function responseQuestionMultiChoices(){
        return $this->hasMany(ResponseQuestionMultiChoice::class);
    }
}
