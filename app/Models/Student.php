<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function responseExams(){
        return $this->hasMany(ResponseExam::class);
    }
    public function hashUrlExams(){
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
    public function responseQuestionTawsil(){
        return $this->hasMany(ResponseQuestionTawsil::class);
    }

    public function studentExams()
    {
        return $this->belongsToMany(Exam::class, 'student_exam');
    }
    public function studentTeachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_teacher');
    }

}
