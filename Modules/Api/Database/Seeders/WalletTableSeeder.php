<?php

namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Entities\Wallet;
use App\User;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = User::where('email', 'john@wallet.io')->first();
        Wallet::create(['user_id' => $user->id, 'created_by'=> 2]);


        $user = User::where('email', 'xerxis@wallet.io')->first();
        Wallet::create(['user_id' => $user->id, 'created_by'=> 2]);
    }
}
