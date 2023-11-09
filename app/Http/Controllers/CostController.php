<?php

namespace App\Http\Controllers;

use App\Models\cost;
use App\Models\budget;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:order.costo.index')->only('index');
        $this->middleware('can:order.costo.create')->only('create', 'store');
    }


    public function index()
    {
        $costo = Cost::select('id_orden', 'precio', 'descripcion', 'estado')->get();
        return view('costos.costoindex', compact('costo'));
    }

    public function create()
    {
    }

    public function store($id)
    {
        $presu = budget::select('id_norden', 'detalle', 'costo')->where('id_norden', $id)->get();
        $suma = $presu->sum('costo');

        $validarpresupuesto = budget::where('id_norden', $id)->exists();
        $validarcosto = cost::where('id_orden', $id)->first();
        if ($validarpresupuesto) {
            if ($validarcosto) {
                $validarcosto->precio = $suma;
                $validarcosto->save();
                return back()->with('info2', 'Presupuesto actualizado');
            } else {
                cost::create([
                    'id_orden' => $id,
                    'precio' => $suma,
                    'estado' => 'En espera de confirmación'
                ]);
                $costoValidar = cost::where('id_orden', $id)->first();
                $validarOrden = order::where('norden', $id)->first();
                $validarOrden->id_costo = $costoValidar->id;
                $validarOrden->save();
                return back()->with('info', 'Presupuesto creado correctamente.');
            }
        } else {
            return back()->with('info2', 'No existen datos para generar presupuesto o hay un presupuesto generado existente');
        }
    }

    public function show($id)
    {
        $budgets = budget::select('id', 'nombre', 'costo', 'detalle')
            ->where('id_norden', $id)
            ->get();
        $costoVerificar = cost::select('id_orden', 'estado')->where('id_orden', $id)->first();
        // return $costoVerificar;
        return view('costos.costoshow', compact('budgets', 'id', 'costoVerificar'));
    }

    public function update()
    {
    }

    // funcion para mostrar el costo y prespuesto en la página de consulta
    public function clientepresupuesto(Request $request, $id)
    {

        $validator = Validator::make(
            [
                'reparacion' => $request->reparacion,
                // 'comentario' => $request->comentario
            ],
            ['reparacion' => ['required', 'in:Aceptado,Rechazado']]
            // 'comentario' => ['required']
        );
        if ($validator->fails()) {
            $presupuesto = [];

            $consult = order::join('customers', 'orders.id_cliente', 'customers.cui')
                ->join('hardware', 'orders.id_equipo', 'hardware.serial')
                ->leftjoin('costs', 'orders.norden', 'costs.id_orden')
                ->select(
                    'orders.norden',
                    'orders.estado',
                    'orders.comentarios',
                    'hardware.marca',
                    'hardware.modelo',
                    'hardware.h_detalles',
                    'customers.nombre',
                    'customers.apellidos',
                    'costs.estado',
                    'costs.precio',

                )
                ->where('orders.norden', $id)
                ->first();
            $presupuesto = budget::select('detalle', 'costo')
                ->where('id_norden', $id)
                ->get();
            // return Redirect::route(compact('constul'))->back();
            // return $consult;
            return back()->with(['query' => $consult, 'estado' => 3, 'presu' => $presupuesto, 'error' => 'Verificar el campo para aceptar o rechazar el presupuesto']);
        }
        $consulta = cost::where('id_orden', $id)->first();
        $consulta->estado = $request->reparacion;
        $consulta->comentario = $request->comentario;
        $consulta->save();

        // devolver datos anteriores
        $presupuesto = [];

        $consult = order::join('customers', 'orders.id_cliente', 'customers.cui')
            ->join('hardware', 'orders.id_equipo', 'hardware.serial')
            ->leftjoin('costs', 'orders.norden', 'costs.id_orden')
            ->select(
                'orders.norden',
                'orders.estado',
                'orders.comentarios',
                'hardware.marca',
                'hardware.modelo',
                'hardware.h_detalles',
                'customers.nombre',
                'customers.apellidos',
                'costs.estado',
                'costs.precio',
                'costs.comentario'
            )
            ->where('orders.norden', $id)
            ->first();
        $presupuesto = budget::select('detalle', 'costo')
            ->where('id_norden', $id)
            ->get();
        return back()->with(['query' => $consult, 'estado' => 3, 'presu' => $presupuesto, 'info' => 'Verificar el campo para aceptar o rechazar el presupuesto']);
    }


    public function aceptar(Request $request)
    {
        // return $request;

        $verificarCosto = cost::where('id_orden', $request->orden)->first();
        // return $costo;
        if ($verificarCosto->estado == 'En espera de confirmación') {
            if ($request->estado == null) {
                return back()->with('info2', 'Verificar el estado');
            }
            $costo = cost::where('id_orden', $request->orden)->first();
            $costo->estado = $request->estado;
            $costo->comentario = $request->comentario;
            $costo->save();
            return back()->with('info', 'Presupuesto modificado');
        }
        return back()->with('info2', 'Verificar datos');
    }
}
