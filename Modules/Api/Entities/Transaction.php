<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [];

    const CREDIT = 2;
    const DEBIT = 1;

    public function currency()
    {
        return $this->belongsTo(ExchangeRate::class, 'exchange_rate_id', 'id');
    }

    public function transtype()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id', 'id');
    }

}
