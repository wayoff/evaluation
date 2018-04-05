<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
    	'student_no',
    	'user_id',
    	'academic_attended',
        'yr_level',
        'strands',
        'course',
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function professors() {
    	return $this->belongsToMany(User::class);
    }

}
