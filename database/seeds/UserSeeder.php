<?php

use App\User;
use Carbon\Carbon;
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
        $user= User::firstOrCreate([
            'name' => 'vilmer',
            'email' => 'david.criollo14@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at'=>Carbon::now()
        ]);
        $user->assignRole('Administrador');
    }
}
