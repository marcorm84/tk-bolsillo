<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $guarded = [];

    public function accounts()
    {
    	return $this->hasMany('App\Account');
    }
}
