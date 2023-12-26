<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Usuario  Prueba',
            'email' => 'userprueba@gmail.com',
            'password' => bcrypt('userprueba'), 
        ]);
    }
    
}
