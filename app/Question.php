<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
    	'title',
		'description',
    ];

    public function choices()
    {
    	return $this->hasMany(Choice::class);
    }

    public function forms()
    {
    	return $this->belongsToMany(Form::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
