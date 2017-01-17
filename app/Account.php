<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];

    const SOLES   = 1;
    const DOLLARS = 2;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBalanceAttribute()
    {
        switch ($this->currency_id) {
            case self::SOLES:
                return 'S/ ' . number_format($this->attributes['balance'], 2);
            case self::DOLLARS:
                return '$ ' . number_format($this->attributes['balance'], 2);
        }
    }
}
