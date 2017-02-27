<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function source()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
