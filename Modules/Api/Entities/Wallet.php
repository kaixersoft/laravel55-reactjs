<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';
    protected $fillable = ['user_id','created_by'];

    public function user() {
        return $this->belongsTo(Wallet::class);
    }
}
