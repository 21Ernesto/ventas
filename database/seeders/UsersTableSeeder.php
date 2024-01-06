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
        
        // Crea un administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'administrador',
        ]);

        // Crea un vendedor
        User::create([
            'name' => 'Vendedor',
            'email' => 'vendedor@gmail.com',
            'password' => bcrypt('vendedor'),
            'role' => 'vendedor',
        ]);
        
    }
}
