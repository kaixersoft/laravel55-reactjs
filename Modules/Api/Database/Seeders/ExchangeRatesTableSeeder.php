<?php

namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Entities\ExchangeRate;

class ExchangeRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        ExchangeRate::create(['currency' => 'sgd']);
    }
}
