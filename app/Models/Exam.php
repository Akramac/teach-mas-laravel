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

    public function questionLongTexts(){
        return $this->belongsToMany(QuestionLongText::class, 'exam_question_long_text');
    }
    public function questionMultiChoices(){
        return $this->belongsToMany(QuestionMultiChoice::class, 'exam_question_multi_choice');
    }
    public function questionSpans(){
        return $this->belongsToMany(QuestionSpan::class, 'exam_question_span');
    }
    public function questionTartibs(){
        return $this->belongsToMany(QuestionTartib::class, 'exam_question_tartib');
    }
    public function questionTawsils(){
        return $this->belongsToMany(QuestionTawsil::class, 'exam_question_tawsil');
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

    public function teacherExams(){
        return $this->belongsToMany(Teacher::class, 'exam_teacher');
    }
    public function studentExams(){
        return $this->belongsToMany(Student::class, 'student_exam');
    }

}
