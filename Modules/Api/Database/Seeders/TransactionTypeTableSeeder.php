<?php
namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Entities\TransactionType;

class TransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        TransactionType::create(['name' => 'Debit']);
        TransactionType::create(['name' => 'Credit']);

    }
}
