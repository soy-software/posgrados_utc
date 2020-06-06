<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;
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
        $email=env('EMAIL_ADMIN', '');
        $user=User::where('email',$email)->first();
        if(!$user){
            $user=new User();
            $user->name = 'Admin';
            $user->email = $email;
            $user->password = Hash::make(env('EMAIL_ADMIN', ''));
            $user->email_verified_at=Carbon::now();
            $user->save();
        }
        $user->assignRole('Administrador');
    }
}
