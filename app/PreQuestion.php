<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreQuestion extends Model
{
    protected $fillable = [
    	'description',
    ];

    public function answers()
    {
    	return $this->hasMany(PreChoice::class);
    }
}
