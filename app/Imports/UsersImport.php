<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user=User::where('email',$row[1])->first();
        if(!$user){
            $user= new User();
            $user->name= $row[0];
            $user->email= $row[1]; 
            $user->password= Hash::make($row[2]);
            $user->save();
            
            $roles = explode(",", $row[3]);
            foreach ($roles as $role) {
                $rol=Role::where('name',$role)->first();    
                if($rol){
                    $user->assignRole($rol);
                }
            }

        }
    
        return $user;
    }
}
