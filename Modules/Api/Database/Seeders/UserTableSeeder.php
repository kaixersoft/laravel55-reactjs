<?php

namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::create([
            'name' => 'John Doe',
            'email' => 'john@wallet.io',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10)
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@wallet.io',
            'password' => bcrypt('secret'),
            'remember_token' => 'Zioj23D92j2kGf9D'
        ]);

        User::create([
            'name' => 'xerxis',
            'email' => 'xerxis@wallet.io',
            'password' => bcrypt('secret'),
            'remember_token' =>  str_random(10)
        ]);


        // Dummy users
        factory(User::class, 5)->create();

    }
}
