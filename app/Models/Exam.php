<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $fillable = [
        'title_exam',
        'duration_exam',
        'teacher_id',
        'categorie_id',
        'allow_screen_record',
        'allow_camera_record',
        'random_questions',
        'no_remake_exam',
        'show_results',
        'show_results',
        'updated_at',
        'created_at',
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function responseExams(){
        return $this->hasMany(ResponseExam::class);
    }
    public function hashUrlExams(){
        return $this->hasMany(HashUrlExam::class);
    }
}
