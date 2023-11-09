<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Hardware;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Customer::create(['cui' => '1234567890123', 'nombre' => 'NombrePrueba', 
        'apellidos' => 'apellidosprueba', 'ncelular' => '49714781']);

        Hardware::create([]);


        $orden = new order();
        $numero = date('d-m-Y:H:s', time());
        $numero = preg_replace('([^A-Za-z0-9])', '', $numero);
        $orden->norden = $numero;
        $orden->id_cliente = '2980028410907';
        $orden->id_equipo = 'arsf315679sw24453dg1e263s';
        $orden->fecha_estimada = '2023-03-20';
        $orden->comentarios = 'Comentarios de prueba';
        $orden->estado = 'No Asignado';
        $orden->save();




    }
}
