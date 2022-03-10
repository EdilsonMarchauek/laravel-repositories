<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Factory utilizada para criar listas fakes, neste caso usuarios
        factory(User::class, 10)->create();    

        /*
        User::create([
            'name' => 'Edilson Marchauek',
            'email' => 'edilson@luna.ppg.br',
            'password' => bcrypt('123')

        ]);
        */

    }
}
