<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
	protected $table = 'evaluations';

	protected $fillable = [
		'user_id',
		'form_id',
		'code_count',
	];

	public function codes()
	{
		return $this->hasMany(Code::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
