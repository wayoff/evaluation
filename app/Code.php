<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'codes';

    protected $fillable = [
    	'evaluation_id',
		'token',
		'confirmed',
    ];

    public function evaluation()
    {
    	return $this->belongsTo(Evaluation::class);
    }
}
