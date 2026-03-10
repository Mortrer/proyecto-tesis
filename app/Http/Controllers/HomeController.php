<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\order;
use App\Models\cost;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:home')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ordenes = order::join('customers', 'customers.id', 'orders.id_cliente')
            ->join('hardware', 'hardware.serial', 'orders.id_equipo')
            ->leftjoin('users', 'users.id', 'orders.id_user')
            ->select(
                'orders.norden',
                'customers.nombre',
                'customers.apellidos',
                'hardware.marca',
                'hardware.modelo',
                'orders.fecha_estimada',
                'orders.estado',
                'users.unombre',
                'users.apellido'
            )
            ->get();
        $tecnico = Auth()->user()->id;
        $ordenrep = order::join('customers', 'orders.id_cliente', 'customers.id')
            ->join('hardware', 'orders.id_equipo', 'hardware.serial')
            ->leftjoin('costs', 'orders.id_costo', 'costs.id')
            ->select(
                'orders.estado',
                'orders.norden',
                'orders.id_equipo',
                'orders.fecha_estimada',
                'customers.nombre',
                'customers.apellidos',
                'hardware.modelo',
                'hardware.marca',
                'costs.estado as costEstado'
            )
            ->where('id_user', $tecnico)
            ->whereIn('orders.estado', ['Asignado', 'En Espera'])
            ->get();
        return view('home', compact('ordenes', 'ordenrep'));
    }
}
