<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:admin.user.index')->only('index');
        $this->middleware('can:admin.user.show')->only('show');
        $this->middleware('can:admin.user.create')->only('create', 'store');
        $this->middleware('can:admin.user.update')->only('update');
    }


    public function index()
    {
        $usuarios = user::select('id', 'usuario', 'unombre', 'apellido')
            ->get();
        return view('users.usersindex', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.userscreate', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
            'apellido' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'rol' => ['required', 'string']
        ]);

        $user = new User();
        $user->unombre = $request->nombre;
        $user->password = Hash::make($request->password);
        $user->usuario = $request->user;
        $user->apellido = $request->apellido;
        $user->roleName = $request->rol;
        $user->assignRole($request->rol);
        $user->save();
        return back()->with('info', 'Usuario creado con éxito');
        // return view('users.userscreate');
    }

    public function show($id)
    {
        $usuario = User::select(
            'id',
            'usuario',
            'unombre',
            'apellido',
            'roleName'
        )
            ->where('id', $id)
            ->first();
        $roles = Role::all();
        return view('users.usersshow', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {

        if ($request->password) {
            # code...
            $this->validate($request, [
                'user' => ['required', 'string'],
                'password' => ['required', 'string', 'confirmed'],
                'apellido' => ['required', 'string'],
                'nombre' => ['required', 'string'],
            ]);
        } else {
            # code...
            $this->validate($request, [
                'user' => ['required', 'string'],
                'apellido' => ['required', 'string'],
                'nombre' => ['required', 'string'],
            ]);
        }


        $user = User::where('id', $id)
            ->first();
        $user->usuario = $request->user;
        $user->unombre = $request->nombre;
        $user->apellido = $request->apellido;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->roleName = $request->tecnico;
        $user->save();
        $user->assignRole($request->tecnico);
        return back()->with('info', 'Se ha actualizado con éxito');
    }
}
