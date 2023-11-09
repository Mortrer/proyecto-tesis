<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            "rnombre" => "Administrador",
            "detalles" => "Encargado de la gestion de usuarios y permisos, puede visualizar todas las opciónes de la plataforma."
        ]);

        DB::table('roles')->insert([
            "rnombre" => "Técnico",
            "detalles" => "Encargado del diagnostico y reparación de los equipos."
        ]);

        DB::table('roles')->insert([
            "rnombre" => "Recepción",
            "detalles" => "Encargado de recepción y entrega de equipos a técnicos y cliente."
        ]);
    }
}
