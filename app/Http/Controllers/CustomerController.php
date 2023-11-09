<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:order.cliente.index')->only('index');
        $this->middleware('can:order.cliente.create')->only('create', 'store');
        $this->middleware('can:order.cliente.show')->only('show');
        $this->middleware('can:order.cliente.updated')->only('updated');
    }


    public function index()
    {
        return view('orders.fragmento');
    }

    public function create()
    {
        return view('orders.fragmento');
    }

    public function cbusqueda(Request $request)
    {
        $cui = $request->cui;
        $nit = $request->nit;
        $cliente = DB::table('customers')
            ->when(!empty($cui), function ($query) use ($cui) {
                return $query->orWhere('cui', 'LIKE', '%' . $cui . '%');
            })
            ->when(!empty($nit), function ($query) use ($nit) {
                return $query->orWhere('nit', 'LIKE', '%' . $nit . '%');
            })
            ->get();

        return $cliente;
    }

    public function store(Request $request)
    {
        $validar = $request->cui;
        $validarnit = $request->nit;
        $dpi = $validar ?? 'Sin especificar';
        $nit = $validarnit ?? 'Sin especificar';

        if ($validar || $validarnit) {
            // Consulta si el cliente existe
            $cliente = DB::table('customers')
                ->when($validar, function ($query) use ($validar) {
                    return $query->where('cui', $validar);
                })
                ->when($validarnit, function ($query) use ($validarnit) {
                    return $query->where('nit', $validarnit);
                })
                ->get();

            if ($cliente->isEmpty()) {
                // El cliente no existe, valida y guarda los datos
                $this->validate($request, [
                    'cui' => ['nullable', 'string', 'max:13', 'min:13'],
                    'nombre' => ['required', 'string'],
                    'apellido' => ['required', 'string'],
                    'celular' => ['required', 'string'],
                    'nit' => ['nullable', 'integer'],
                    'correo' => ['nullable', 'email']
                ]);

                $customer = new Customer();
                $customer->cui = $request->cui;
                $customer->nombre = $request->nombre;
                $customer->apellidos = $request->apellido;
                $customer->ncelular = $request->celular;
                $customer->nit = $request->nit;
                $customer->correo = $request->correo;
                $customer->save();

                // Redirecciona después de guardar los datos
                $dpi = $request->cui ?? 'Sin especificar';
                $nit = $request->nit ?? 'Sin especificar';
            } else {
                // El cliente ya existe, realiza la redirección
                $dpi = $validar ?? 'Sin especificar'; // Utiliza el valor validado
                $nit = $validarnit ?? 'Sin especificar'; // Utiliza el valor validado
            }
        } else {
            return redirect()->back()->with('error', 'Debes proporcionar al menos DPI o NIT.');
        }
        return Redirect::route('order.hardware', ['dpi' => $dpi, 'nit' => $nit]);
    }


    public function updated(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'celular' => ['required', 'int'],
        ]);
        $customer = Customer::find($request->cui);
        $customer->nombre = $request->nombre;
        $customer->apellidos = $request->apellidos;
        $customer->ncelular = $request->celular;
        $customer->save();
        return back()->with('info', 'La actualización se realizo con éxito en la sección de Cliente');
    }
}
