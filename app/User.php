<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'user_type', 'username', 'first_name', 'last_name', 'middle_name', 'department',
    ];

    /**
     * append attribute
     */
    protected $appends = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function getUserTypeAttribute($value)
    {
        return config('user-type')[$value];
    }

    public function getNameAttribute()
    {
        $lastName = empty($this->middle_name) 
            ? $this->last_name
            : $this->middle_name . ' ' . $this->last_name;

        return $this->first_name . ' ' . $lastName;
    }

    public function scopeFaculty($query)
    {
        return $query->where('user_type', 2);
    }

    public function isStudent()
    {
        return $this->user_type == 'student';
    }

    public function isFaculty()
    {
        return $this->user_type == 'faculty';
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
