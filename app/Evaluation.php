<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
	protected $table = 'evaluations';

	protected $fillable = [
		'user_id',
		'form_id',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function form() 
	{
		return $this->belongsTo(Form::class);
	}

	public function answers()
	{
		return $this->hasMany(Answer::class);
	}
}
