<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
    	'user_id',
		'evaluation_id',
		'comment',
    ];

    public function studentAnswers() {
    	return $this->hasMany(StudentAnswer::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
