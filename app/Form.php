<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
    	'title',
    	'start_date',
    	'end_date',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
    ];

    public function questions() {
    	return $this->belongsToMany(Question::class);
    }

    public function evaluations() {
        return $this->hasMany(Evaluation::class);
    }
}
