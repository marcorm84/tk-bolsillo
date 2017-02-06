<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function labels()
    {
        return $this->belongsToMany('App\Label', 'transaction_labels');
    }

    public function type()
    {
    	return $this->belongsTo('App\TransactionType');
    }
}
