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
        $email='david.criollo14@gmail.com';
        $user=User::where('email',$email)->first();
        if(!$user){
            $user=new User();
            $user->name = 'vilmer';
            $user->email = $email;
            $user->password = Hash::make('12345678');
            $user->email_verified_at=Carbon::now();
            $user->save();
        }
        $user->assignRole('Administrador');
    }
}
