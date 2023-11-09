<?php

namespace App\Http\Controllers;

use App\Models\budget;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;


class BudgetController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('can:order.budget.index')->only('index');
        $this->middleware('can:order.budget.create')->only('create', 'store');
        $this->middleware('can:order.budget.show')->only('show');
        $this->middleware('can:order.budget.delete')->only('delete');
    }

    public function index()
    {
    }

    public function create($dato)
    {
        $id = $dato;
        $budg = budget::select('id', 'id_norden', 'nombre', 'detalle', 'costo')->where('id_norden', $id)->get();
        return view('presupuesto.presupuestocreate', compact('id', 'budg'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'detalle' => ['required', 'string'],
            'costo' => ['required', 'int']
        ]);
        $budget = new budget();
        $budget->id_norden = $id;
        $budget->nombre = $request->nombre;
        $budget->costo = $request->costo;
        $budget->detalle = $request->detalle;
        $budget->save();
        $budg = budget::select('id')->where('id_norden', $id)->get();
        return view('presupuesto.presupuestocreate', compact('id', 'budg'));
    }

    public function guardar(Request $request)
    {
        $request->costo = round($request->costo * 100) / 100;
        $this->validate($request, [
            'costo' => ['required', 'numeric'],
            'id_norden' => ['required', 'int'],
            'detalle' => ['required', 'string'],
            'categoria' => ['required', 'string'],
            'tipo' => ['required', 'string']
        ]);
        $budget = new budget();
        $budget->id_norden = $request->id_norden;
        $budget->nombre = $request->categoria;
        $budget->tipo = $request->tipo;
        $budget->costo = $request->costo;
        $budget->detalle = $request->detalle;
        $budget->save();
        return back()->with('info', 'Agregado correctamente');
    }

    public function destoy($id)
    {
        $budget = budget::select()->where('id', $id)->first();
        $budget->delete();
        return back()->with('info', 'Eliminado correctamente');
    }

    public function bpresu(Request $request)
    {
        $orden = $request->orden;
        $busqueda = budget::select('id_norden', 'nombre', 'detalle', 'costo')
            ->where('id_norden', $orden)
            ->get();
        return $busqueda;
        // return $busqueda;
    }
}
