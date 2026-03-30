<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HashUrlExam extends Model
{
    use HasFactory;

    protected $table = 'hash_url_exam';

    protected $fillable = [
        'teacher_id',
        'exam_id',
        'student_id',
        'hash',
        'used_once_by_student',
        'updated_at',
        'created_at',
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
