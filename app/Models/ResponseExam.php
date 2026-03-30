<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseExam extends Model
{
    use HasFactory;

    protected $table = 'response_exam';

    protected $fillable = [
        'teacher_id',
        'student_id',
        'exam_id',
        'note_by_teacher',
        'show_notes',
        'file_screen',
        'file_video',
        'date_created',
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
