<?php

namespace App\Http\Controllers;

use App\Models\budget;
use App\Models\cost;
use App\Models\order;
use App\Models\Customer;
use App\Models\User;
use App\Models\Hardware;
use App\Models\viewOrder;
use Hamcrest\Number\OrderingComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\MockObject\Builder\ParametersMatch;
use PHPUnit\Framework\MockObject\Rule\Parameters;
use Symfony\Component\Console\Input\Input;

class OrderController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('can:order.index')->only('index');
        $this->middleware('can:order.create')->only('create', 'store');
        $this->middleware('can:order.show')->only('show');
        $this->middleware('can:order.asig')->only('asignar1');
        $this->middleware('can:order.asignado')->only('asignar');
        $this->middleware('can:order.update')->only('update');
        $this->middleware('can:order.updated')->only('updated');
        $this->middleware('can:order.imprimir')->only('imprimir');
        $this->middleware('can:order.rep')->only('repair');
        $this->middleware('can:order.repord')->only('repairord');
        $this->middleware('can:order.repf')->only('repairf');
    }

    public function index()
    {
        $ordenes = order::join('customers', 'customers.id', 'orders.id_cliente')
            ->leftjoin('hardware', 'hardware.serial', 'orders.id_equipo')
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
        return view('orders.ordenindex', compact('ordenes'));
    }

    public function showa()
    {
        $ordenes = Order::join('customers', 'customers.id', 'orders.id_cliente')
            ->leftjoin('hardware', 'hardware.serial', 'orders.id_equipo')
            ->select('orders.norden', 'customers.nombre', 'customers.apellidos', 'hardware.marca', 'hardware.modelo', 'orders.fecha_estimada', 'orders.id_user')
            ->whereNull('id_user')->get();
        $tecnico = DB::table('users')
            ->select('id', 'usuario', 'unombre', 'apellido', 'roleName')
            ->where('roleName', 'Técnico')
            ->orwhere('roleName', 'Administrador')
            ->get();
        // return $tecnico;
        return view('orders.ordenasignar', compact('ordenes', 'tecnico'));
    }

    public function asignar(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'orden' => ['required', 'string'],
            'tecnico' => ['required', 'integer'],

        ]);

        $orden = Order::select('norden', 'id_user', 'estado')
            ->where('norden', $request->orden)
            ->first();
        $orden->id_user = $request->tecnico;
        $orden->estado = "Asignado";
        $orden->save();
        return redirect::route('order.asig')->with('info', 'Orden de Trabajo asignada correctamente');
    }

    //consulta que se envia a la vista ordena1 para mostrar los datos de la orden que se va a asignar.
    public function asignar1($id)
    {
        $orden = order::join('customers', 'customers.id', 'orders.id_cliente')
            ->leftjoin('hardware', 'hardware.serial', 'orders.id_equipo')
            ->select('orders.norden', 'customers.nombre', 'customers.apellidos', 'hardware.serial', 'hardware.marca', 'hardware.modelo', 'hardware.tipo', 'orders.comentarios')
            ->where('norden', $id)
            ->first();
        $tecnico = DB::table('users')
            ->select('id', 'usuario', 'unombre', 'apellido', 'roleName')
            ->where('roleName', 'Técnico')
            ->orwhere('roleName', 'Administrador')
            ->get();
        return view('orders.ordena1', compact('orden', 'tecnico'));
    }

    public function obusqueda(Request $request)
    {
        $orden = $request->busqueda;
        $nordenes = DB::table('orders')->where('norden', 'LIKE', '%' . $orden . '%')->get();
        return $nordenes;
    }

    public function show($id)
    {

        $ordenv = order::join('customers', 'customers.id', 'orders.id_cliente')
            ->leftjoin('hardware', 'hardware.serial', 'orders.id_equipo')
            ->leftjoin('costs', 'costs.id_orden', 'orders.norden')
            ->leftjoin('users', 'users.id', 'orders.id_user')
            ->select(
                'orders.norden',
                'orders.id_cliente',
                'orders.id_cliente',
                'orders.id_equipo',
                'orders.estado',
                'orders.id_user',
                'orders.fecha_estimada',
                'orders.created_at',
                'orders.comentarios',
                'customers.cui',
                'customers.nit',
                'customers.nombre',
                'customers.apellidos',
                'customers.ncelular',
                'customers.correo',
                'hardware.marca',
                'hardware.modelo',
                'hardware.h_detalles',
                'hardware.tipo',
                'users.unombre',
                'users.apellido',
                'costs.precio',
                'costs.estado as costoEstado',
                'costs.descripcion',
                'costs.comentario'
            )
            ->where('norden', $id)
            ->first();
        // return $ordenv;
        return view('orders.showorden', compact('ordenv'));
    }

    public function create($cui, $nombre, $apellido, $marca, $modelo, $comentarios, $serial, $customid, $nitval, $tipo)
    {
        return view('orders.ordencrear', compact('cui', 'nombre', 'apellido', 'marca', 'modelo', 'comentarios', 'serial', 'customid', 'nitval', 'tipo'));
    }

    //función para crear un registro y generar una orden
    public function store(Request $request)
    {
        $this->validate($request, [
            'num' => ['required', 'int'],
            'serial' => ['required', 'string'],
            'fecha_estimada' => ['required', 'date'],
            'problema' => ['required', 'string'],
        ]);
        $orden = new order();
        $numero = date('d-m-Y:H:s', time());
        $numero = preg_replace('([^A-Za-z0-9])', '', $numero);
        $orden->norden = $numero;
        $orden->id_cliente = $request->num;
        $orden->id_equipo = $request->serial;
        $orden->fecha_estimada = $request->fecha_estimada;
        $orden->comentarios = $request->problema;
        $orden->estado = 'No Asignado';
        $orden->save();
        $norden = $orden->norden;
        return Redirect::route('order.imprimir', $norden)->with('info', 'Orden creada con éxito');
    }

    //función para mostrar los datos que se necesitan actualizar
    public function update($orden)
    {
        $cliente = order::select('id_cliente')->where('norden', $orden)->first()->id_cliente;
        $consulta = Order::join('customers', 'orders.id_cliente', 'customers.id')
            ->leftjoin('hardware', 'orders.id_equipo', 'hardware.serial')
            ->select(
                'orders.norden',
                'orders.estado',
                'orders.fecha_estimada',
                'orders.comentarios',
                'customers.id',
                'customers.cui',
                'customers.nit',
                'customers.nombre',
                'customers.apellidos',
                'customers.ncelular',
                'customers.correo',
                'hardware.modelo',
                'hardware.marca',
                'hardware.tipo',
                'hardware.h_detalles',
                'hardware.serial'
            )
            ->where('orders.id_cliente', $cliente)
            ->where('orders.norden', $orden)
            ->first();
        $asignado = order::join('users', 'users.id', 'orders.id_user')
            ->select('orders.id_user', 'users.unombre', 'users.apellido')
            ->where('orders.norden', $orden)
            ->first();
        $usuario = user::select('id', 'unombre', 'apellido')->where('roleName', 'Administrador')->orWhere('roleName', 'Técnico')->get();
        // return $consulta;
        return view('orders.update', compact('consulta', 'usuario', 'asignado'));
    }

    //función para guardar los datos de actualización
    public function updated(Request $request, $id)
    {

        $order = order::where('norden', $id)->first();
        $order->comentarios = $request->comentarios;
        $order->id_user = $request->tecnico;
        $order->estado = $request->estado;
        $order->fecha_estimada = $request->fecha_estimada;
        $order->save();
        return back()->with('info', 'La actualización se realizo con éxito en la sección de Orden de Trabajo');
    }


    public function imprimir($norder)
    {
        $cliente = order::select('id_cliente')->where('norden', $norder)->first()->id_cliente;
        $query = order::join('customers', 'orders.id_cliente', 'customers.id')
            ->leftjoin('hardware', 'orders.id_equipo', 'hardware.serial')
            ->select('orders.norden', 'customers.nombre', 'customers.apellidos', 'customers.ncelular', 'customers.nit', 'customers.cui', 
            'orders.id_equipo', 'orders.comentarios', 'orders.created_at', 'orders.fecha_estimada', 'hardware.serial', 'hardware.marca', 
            'hardware.modelo', 'hardware.h_detalles', 'hardware.tipo')
            ->where('orders.id_cliente', $cliente)
            ->where('orders.norden', $norder)
            ->first();
        return view('orders.imprimir', compact('query'));
    }

    public function repair()
    {
        $tecnico = Auth()->user()->id;
        $ordenes = order::join('customers', 'orders.id_cliente', 'customers.id')
            ->leftjoin('hardware', 'orders.id_equipo', 'hardware.serial')
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
        // return $ordenes;
        return view('orders.ordenrep', compact('ordenes'));
    }
    public function repairord($norden)
    {
        $order = order::join('customers', 'orders.id_cliente', 'customers.id')
            ->leftjoin('hardware', 'orders.id_equipo', 'hardware.serial')
            ->leftjoin('costs', 'orders.id_costo', 'costs.id')
            ->select(
                'orders.norden',
                'orders.id_equipo',
                'orders.fecha_estimada',
                'orders.comentarios',
                'orders.estado',
                'customers.nombre',
                'customers.apellidos',
                'customers.ncelular',
                'hardware.marca',
                'hardware.modelo',
                'hardware.h_detalles',
                'hardware.tipo',
                'costs.precio',
                'costs.estado as costEstado',
                'costs.comentario'
            )
            ->where('orders.norden', $norden)
            ->first();
        $costo = cost::select('descripcion')
            ->where('id_orden', $norden)->first();
        // return $order;
        return view('orders.ordenrepshow', compact('order', 'costo'));
    }

    public function consu(Request $request)
    {
        $id = $request->cons;
        $consult = order::join('customers', 'orders.id_cliente', 'customers.id')
            ->leftjoin('hardware', 'orders.id_equipo', 'hardware.serial')
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
                'costs.estado as costEstado',
                'costs.precio',
                'costs.comentario'
            )
            ->where('orders.norden', $id)
            ->first();
        if ($consult) {
            # code...
            $estadodb = viewOrder::where('id_orden', $request->cons)->first();
            if ($estadodb) {
                $estado = $estadodb->estado;
            } else {
                $estado = new viewOrder();
                $estado->id_orden = $request->cons;
                $estado->estado = 1;
                $estado->save();
            }

            // return Redirect::route(compact('constul'))->back();
            $presupuesto = budget::select('detalle', 'costo')
                ->where('id_norden', $id)
                ->get();
            // return $presupuesto;
            return back()->with(['query' => $consult, 'estado' => $estado, 'presu' => $presupuesto]);
        } else {
            return back()->with('error', 'No se encontraron resultados para la orden especificada.');;
        }
    }

    public function entrega(Request $request)
    {
        $consulta = order::select('estado')
            ->where('norden', $request->orden)
            ->first();
        if ($consulta->estado == 'Reparado' || $consulta->estado == 'No Reparado') {
            $orden = order::find($request->orden);
            $orden->estado = 'Entregado';
            $orden->fecha_egreso = date('Y-m-d H:i');
            $orden->save();
            return back()->with('info', 'Registro completado');
        } else {
            return back()->with('info2', 'Aún no se puede entregar');
        }
    }

    public function estadovisita($id, $estado)
    {
        $estadodb = viewOrder::where('id_orden', $id)->first();
        $estadodb->estado = $estado;
        $presupuesto = [];
        $estadodb->save();
        if ($estado == 1) {
            $consult = order::join('customers', 'orders.id_cliente', 'customers.id')
                ->join('hardware', 'orders.id_equipo', 'hardware.serial')
                ->select(
                    'orders.norden',
                    'orders.estado',
                    'orders.comentarios',
                    'hardware.marca',
                    'hardware.modelo',
                    'hardware.h_detalles',
                    'customers.nombre',
                    'customers.apellidos'
                )
                ->where('orders.norden', $id)
                ->first();
        }
        if ($estado == 2) {
            $consult = order::join('customers', 'orders.id_cliente', 'customers.id')
                ->leftjoin('hardware', 'orders.id_equipo', 'hardware.serial')
                ->select(
                    'orders.norden',
                    'orders.estado',
                    'orders.comentarios',
                    'hardware.marca',
                    'hardware.modelo',
                    'hardware.h_detalles',
                    'customers.nombre',
                    'customers.apellidos'
                )
                ->where('orders.norden', $id)
                ->first();
        }
        if ($estado == 3) {
            $consult = order::join('customers', 'orders.id_cliente', 'customers.id')
                ->leftjoin('hardware', 'orders.id_equipo', 'hardware.serial')
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
                    'costs.estado as costEstado',
                    'costs.precio',
                    'costs.comentario'
                )
                ->where('orders.norden', $id)
                ->first();
            $presupuesto = budget::select('detalle', 'costo')
                ->where('id_norden', $id)
                ->get();
        }
        return back()->with(['query' => $consult, 'estado' => $estado, 'presu' => $presupuesto]);
    }


    public function repairf(Request $request)
    {
        $this->validate($request, [
            'reparacion' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'orden' => ['required', 'string']

        ]);
        $verificarCosto = cost::select('id_orden', 'estado')
            ->where('id_orden', $request->orden)->first();
        if ($verificarCosto->estado == 'Aceptado' || $verificarCosto->estado == 'Rechazado') {
            if ($request->estado == 'Asignado') {
                return back()->with('info3', 'Verificar el estado de la orden');
            } else {

                $consulta = order::find($request->orden);
                $costo = cost::where('id_orden', $request->orden)->first();
                $costo->descripcion = $request->reparacion;
                $costo->save();
                if ($consulta->estado == 'Reparado' || $consulta->estado == 'No Reparado') {
                    return back()->with('info2', 'La orden a pasado a un estado de Reparado, No reparado o Entregado');
                }
                $consulta->estado = $request->estado;
                $consulta->save();
                return back()->with('info', 'Guardado con éxito');
            }
        } else {
            return back()->with('info3', 'Verificar datos');
        }
    }

}
