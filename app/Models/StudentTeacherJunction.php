<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTeacherJunction extends Model
{
    use HasFactory;

    protected $table = 'student_teacher';

    protected $fillable = [
        'teacher_id',
        'student_id',
        'created_at',
        'updated_at',
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
