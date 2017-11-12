<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
    	'question_id',
    	'decription',
		'order',
    ];

    public function question() 
    {
    	return $this->hasOne(Question::class);
    }
}
