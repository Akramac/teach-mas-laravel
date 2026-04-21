<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExamJunction extends Model
{
    use HasFactory;

    protected $table = 'student_exam';

    protected $fillable = [
        'exam_id',
        'student_id',
        'created_at',
        'updated_at',
    ];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
