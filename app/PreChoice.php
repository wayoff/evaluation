<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreChoice extends Model
{
    protected $fillable = [
    	'pre_question_id',
    	'decription',
		'order',
    ];

    public function question() 
    {
    	return $this->hasOne(Question::class);
    }
}
