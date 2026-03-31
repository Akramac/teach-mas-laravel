<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'approved_by_admin',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function exams(){
        return $this->hasMany(Exam::class);
    }
    public function responseExams(){
        return $this->hasMany(ResponseExam::class);
    }
    public function hashUrlExam(){
        return $this->hasMany(HashUrlExam::class);
    }
    public function responseQuestionLongs(){
        return $this->hasMany(ResponseQuestionLongText::class);
    }
    public function responseQuestionMultiChoices(){
        return $this->hasMany(ResponseQuestionMultiChoice::class);
    }
    public function responseQuestionSpan(){
        return $this->hasMany(ResponseQuestionSpan::class);
    }
    public function responseQuestionTartib(){
        return $this->hasMany(ResponseQuestionTartib::class);
    }
}
