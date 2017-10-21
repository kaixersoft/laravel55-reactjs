<?php
namespace Modules\Api\Tools;

use Modules\Api\Entities\Transaction;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;


class TransactionCodeGenerator
{
    public function generate()
    {
        try {
            $code = 'W'.date('YmdHis');
            while(Transaction::where('transaction_code', $code)->first()) {
                $code = 'W'.date('YmdHis');
            }
            return $code;
        } catch (UnsatisfiedDependencyException $e) {
            throw $e;
        }
    }
}