<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as RoleSpatie;

class RoleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('can:role.index')->only('index');
        $this->middleware('can:role.show')->only('show');
        $this->middleware('can:role.create')->only('create', 'store');
        $this->middleware('can:role.delete')->only('delete');
        $this->middleware('can:role.update')->only('update');
    }


    public function index()
    {
        $rols = role::select('id', 'name')->get();
        return view('roles.rolesindex', compact('rols'));
    }

    public function show($id)
    {
        $rol = Role::find($id);
        // $pasignado = Permission::select('id', 'name')
        // ->where('');
        $permisos = Permission::select('id', 'name', 'description')->get();
        $permisionAsigned = RoleSpatie::find($id)->permissions;
        // return $pasignado;
        return view('roles.rolshow', compact('permisos', 'rol', 'permisionAsigned'));
    }


    public function create()
    {
        $permisos = Permission::select('id', 'name', 'description')->get();
        return view('roles.rolescrear', compact('permisos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $rolexist = RoleSpatie::select('name')
            ->where('name', $request->name)->first();
        if ($rolexist) {
            return back()->with('info2', 'Existe un rol con ese nombre');
        }

        $rol = new RoleSpatie();
        $rol->name = $request->name;
        $rol->save();
        $rol->permissions()->sync($request->permisos);

        return back()->with('info', 'Rol creado con éxito');
    }

    public function delete($id)
    {
        $rol = role::find($id);
        $rol->delete();
        return back()->with('info', 'Role Eliminado');
    }


    public function update(Request $request)
    {
        $rolexist = RoleSpatie::where('name', $request->nombre)->first();
        if ($rolexist) {
            $rolexist->permissions()->sync($request->permisos);
        }
        return back()->with('info3', 'Actualización realizada con éxito');
    }
}
