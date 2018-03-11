<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
    	'answer_id',
		'question_id',
		'value',
    ];

    public function question() {
    	return $this->belongsTo(Question::class);
    }
}
