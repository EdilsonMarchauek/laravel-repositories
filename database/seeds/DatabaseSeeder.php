<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    // Primeiro Passo: criar a classe UserTableSeeder
    // php artisan make:seeder UsersTableSeeder 
    // Criação de um usuário default no bd
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}
