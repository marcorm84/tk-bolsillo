<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $guarded = [];

    public function transactions()
    {
    	return $this->belongsToMany('App\Transaction', 'transaction_labels');
    }
}
