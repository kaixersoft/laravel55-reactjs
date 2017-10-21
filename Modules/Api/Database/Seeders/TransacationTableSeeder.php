<?php

namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Entities\Transaction;
use Modules\Api\Tools\TransactionCodeGenerator;

class TransacationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Transaction::create([
           'wallet_id' => 1,
           'transaction_type_id' => 2,
            'exchange_rate_id' => 1,
            'amount' => 1000.00,
            'transaction_code' => (new TransactionCodeGenerator)->generate(),
            'remarks' => 'initial deposit'
        ]);

        Transaction::create([
            'wallet_id' => 1,
            'transaction_type_id' => 1,
            'exchange_rate_id' => 1,
            'amount' => -35.50,
            'transaction_code' => (new TransactionCodeGenerator)->generate(),
            'remarks' => 'uber surcharged'
        ]);


        Transaction::create([
            'wallet_id' => 1,
            'transaction_type_id' => 1,
            'exchange_rate_id' => 1,
            'amount' => -25.32,
            'transaction_code' => (new TransactionCodeGenerator)->generate(),
            'remarks' => null
        ]);

        Transaction::create([
            'wallet_id' => 1,
            'transaction_type_id' => 2,
            'exchange_rate_id' => 1,
            'amount' => 5.00,
            'transaction_code' => (new TransactionCodeGenerator)->generate(),
            'remarks' => 'savings'
        ]);



    }
}
