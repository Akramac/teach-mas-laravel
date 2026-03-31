<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTawsil extends Model
{
    use HasFactory;

    protected $table = 'question_tawsil';

    protected $fillable = [
        'user_id',
        'no_specific_time',
        'title',
        'duration',
        'option_1',
        'link_option_1',
        'option_2',
        'link_option_2',
        'option_3',
        'link_option_3',
        'option_4',
        'link_option_4',
        'option_5',
        'link_option_5',
        'option_6',
        'link_option_6',
        'file_url',
        'points',
        'image',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
