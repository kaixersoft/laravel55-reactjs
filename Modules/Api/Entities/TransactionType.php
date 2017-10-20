<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $table = 'transaction_types';
    protected $fillable = ['name'];
}
