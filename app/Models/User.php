<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'verification_key',
        'is_email_verified',
        'user_level',
        'image',
        'created_at',
        'updated_at',
    ];

    // Specify the primary key (optional)
    protected $primaryKey = 'id';


    public function students(){
        return $this->hasMany(Student::class);
    }
    public function teachers(){
        return $this->hasMany(Teacher::class);
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
    public function hasRole($role)
    {
        return $this->user_level === $role;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function levelName():Attribute{
         return Attribute::make(
            get: fn () => match ($this->user_level){
                'ROLE_TEACHER' => 'ROLE TEACHER',
                'ROLE_STUDENT' => 'ROLE STUDENT',
                'ROLE_ADMIN' =>'ROLE ADMIN'
            }
         );
    }
    }
