<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Leonidas Cruz',
            'email' => 'leo@yahoo.com',
            'password' => Hash::make('12345678'),
        ]);

        //$user->perfil()->create();

        $user2 = User::create([
            'name' => 'Carlos González',
            'email' => 'carlos@yahoo.com',
            'password' => Hash::make('12345678'),
        ]);

        //$user2->perfil()->create();
    }
}
