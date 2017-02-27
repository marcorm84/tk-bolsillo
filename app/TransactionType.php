<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $guarded = [];

    const INCOME  = 1;
    const EXPENSE = 2;
    const LOAN    = 3;
    const DEBT    = 4;
}
