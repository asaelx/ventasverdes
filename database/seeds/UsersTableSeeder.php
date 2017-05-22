<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin
        $user = User::create([
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        $user->profile()->create([
            'firstname' => 'Admin',
            'lastname' => 'Ventas Verdes'
        ]);

        $seller = User::create([
            'username' => 'vendedor',
            'email' => 'vendedor@mail.com',
            'password' => bcrypt('vendedor'),
            'role' => 'seller'
        ]);

        $seller->profile()->create([
            'firstname' => 'Vendedor',
            'lastname' => 'Ejemplo'
        ]);

        $customer = User::create([
            'username' => 'comprador',
            'email' => 'comprador@mail.com',
            'password' => bcrypt('comprador'),
            'role' => 'customer'
        ]);

        $customer->profile()->create([
            'firstname' => 'Comprador',
            'lastname' => 'Ejemplo'
        ]);
    }
}
