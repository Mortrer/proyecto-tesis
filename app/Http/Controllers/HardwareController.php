<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hardware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HardwareController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:order.hardware')->only('index');
        $this->middleware('can:order.hardware.create')->only('create', 'store');
        $this->middleware('can:order.hardware.update')->only('update');
        $this->middleware('can:order.hardware.show')->only('show');
    }

    public function index($dpi = null, $nit = null)
    {
        return view('orders.hardware', compact('dpi', 'nit'));
    }

    public function create()
    {
        return 'estas seguro que es aca?';
    }

    public function hbusqueda(Request $request)
    {
        $serial = $request->serial;
        $hardware = DB::table('hardware')->where('serial', 'LIKE', '%' . $serial . '%')->get();
        return $hardware;
    }

    public function store(Request $request)
    {
        $cuiv = $request->cliente;
        $nitv = $request->nit;
        $this->validate($request, [
            'serial' => ['required', 'string', 'min:10', 'max:34'],
            'detalles' => ['required', 'string'],
            'marca' => ['required', 'string'],
            'modelo' => ['required', 'string']
        ]);

        $cui = $cuiv;
        $nit = $nitv;
        $serial = $request->serial;
        $marca = $request->marca;
        $modelo = $request->modelo;
        $comentarios = $request->detalles;
        $tipo = $request->tipo;

        if (Hardware::where('serial', $serial)->exists()) {
            // El serial existe en la base de datos
            $hard = Hardware::where('serial', $serial)->first();
            $cliente = Customer::when($cui, function ($query) use ($cui) {
                return $query->where('cui', $cui);
            })->when(!$cui && $nit, function ($query) use ($nit) {
                return $query->where('nit', $nit);
            })->first();

            $nitval = $cliente->nit ?? "Sin especificar";
            return Redirect::route('order.create', [
                'customid' => $cliente->id,
                'cui' => $cui ?? "Sin especificar",
                'nitval' => $nitval,
                'nombre' => $cliente->nombre,
                'apellido' => $cliente->apellidos,
                'marca' => $hard->marca,
                'modelo' => $hard->modelo,
                'comentarios' => $comentarios,
                'serial' => $serial,
                'tipo' => $tipo
            ]);
        } else {
            // El serial no existe en la base de datos
            $cliente = Customer::when($cui, function ($query) use ($cui) {
                return $query->where('cui', $cui);
            })->when(!$cui && $nit, function ($query) use ($nit) {
                return $query->where('nit', $nit);
            })->first();
            $hardware = new Hardware();
            $hardware->serial = $serial;
            $hardware->marca = $marca;
            $hardware->modelo = $modelo;
            $hardware->h_detalles = $comentarios;
            $hardware->tipo = $tipo;
            $hardware->id_cliente = $cliente->id;
            $hardware->save();
            $nitval = $cliente->nit ?? "Sin especificar";
            return Redirect::route('order.create', [
                'customid' => $cliente->id,
                'cui' => $cui ?? "Sin especificar",
                'nitval' => $nitval,
                'nombre' => $cliente->nombre,
                'apellido' => $cliente->apellidos,
                'marca' => $marca,
                'modelo' => $modelo,
                'comentarios' => $comentarios,
                'serial' => $serial,
                'tipo' => $tipo
            ]);
        }
    }


    public function updated(Request $request)
    {
        $hardware = Hardware::find($request->serial);
        $hardware->marca = $request->marca;
        $hardware->modelo = $request->modelo;
        $hardware->h_detalles = $request->detalles;
        $hardware->save();
        return back()->with('info', 'La actualización se realizo con éxito en la sección de Hardware');
        // return $hardware;
    }
}
