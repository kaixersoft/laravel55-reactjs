<?php

namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Entities\ExchangeRate;

class ApiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(UserTableSeeder::class);
         $this->call(WalletTableSeeder::class);
         $this->call(TransactionTypeTableSeeder::class);
         $this->call( ExchangeRatesTableSeeder::class);
         $this->call(TransacationTableSeeder::class);
    }
}
