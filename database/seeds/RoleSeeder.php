<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
         
        // permisos
        Permission::firstOrCreate(['name' => 'Usuarios']);
        Permission::firstOrCreate(['name' => 'Maestrías']);
        $p_v_r=Permission::firstOrCreate(['name' => 'Validar registros']);
        $p_r_i=Permission::firstOrCreate(['name' => 'Realizar inscripciones']);
        $p_v_m=Permission::firstOrCreate(['name' => 'Validar matrícula']);

        // roles
        $role = Role::firstOrCreate(['name' => 'Administrador']); // total sistema
        $r_s=Role::firstOrCreate(['name' => 'Secretaría académica']); // posgrados
        $r_s->givePermissionTo($p_r_i);
        $role_d_f=Role::firstOrCreate(['name' => 'Departamento financiero tesorería']); //utc
        $role_d_f->givePermissionTo($p_v_r,$p_v_m);
        Role::firstOrCreate(['name' => 'Coordinador de maestría']); // posgrados
        Role::firstOrCreate(['name' => 'Postulante']); //para inscripcion es =Postulante
        Role::firstOrCreate(['name' => 'Aspirante']); // para admision es = Aspirante
        Role::firstOrCreate(['name' => 'Alumnos']); // para matricula es =alumno
        Role::firstOrCreate(['name' => 'Docente']); // utc
        $role->givePermissionTo(Permission::all());
    }
}
