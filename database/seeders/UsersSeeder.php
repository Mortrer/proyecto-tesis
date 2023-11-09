<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role as RoleSpatie;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->usuario = "Admin";
        $user->unombre = "Administrador";
        $user->apellido = "Prueba";
        $user->password = Hash::make("123456789");
        $user->roleName = 'Administrador';
        $user->assignRole('Administrador');
        // $user->id_rol = "1";
        $user->save();


       $tecnico = User::create([
            'usuario' => 'tec1',
            'unombre' => 'Técnico',
            'apellido' => 'Prueba',
            'password' => Hash::make('123456789'),
            'roleName' => 'Técnico'
            
        ]);

        $tecnico->assignRole('Técnico');

        $recepcion = User::create([
            'usuario' => 'recep1',
            'unombre' => 'Recepción',
            'apellido' => 'Prueba',
            'password' => Hash::make('123456789'),
            'roleName' => 'Recepción'
        ]);

        $recepcion->assignRole('Recepción');


    }
}
