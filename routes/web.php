<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CostController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Hardware;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//hacia falta tu ruta raiz XD
Route::get('/', function () {
    return view('welcome');
})->name('login');

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () { //protege las rutas para que solo puedan ingresar usuarios autenticados

    //grupo de rutas para las distintas funciones    

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/servicio_tecnico/usuarios/rolindex', [RoleController::class, 'index'])->name('role.index');

    Route::get('/servicio_tecnico/usuarios/rolindex/ver/{id?}', [RoleController::class, 'show'])->name('role.show');

    Route::post('/servicio_tecnico/rol/update/{id?}', [RoleController::class, 'update'])->name('role.update');

    Route::get('/servicio_tecnico/usuarios/rolindex/crear', [RoleController::class, 'create'])->name('role.create');

    Route::get('/servicio_tecnico/usuarios/rol/{id?}', [RoleController::class, 'delete'])->name('role.delete');

    Route::post('/rol', [RoleController::class, 'store'])->name('rol.store');

    /*
rutas para usuario
*/

    Route::get('servicio_tecnico/usuarios', [UserController::class, 'index'])->name('user.index');

    Route::get('servicio_tecnico/usuarios/{id?}/show', [UserController::class, 'show'])->name('user.show');

    Route::get('servicio_tecnico/usuarios/crear', [UserController::class, 'create'])->name('user.create');

    Route::post('usuarios', [UserController::class, 'store'])->name('user.store');

    Route::post('Servicio_tecnico/{id}/update', [UserController::class, 'update'])->name('user.update');

    /*
ruta para ordenes
*/

    Route::get('servicio_tecnico/ordenes', [OrderController::class, 'index'])->name('order.index');

    Route::get('servicio_tecnico/ordenes/crear/{cui}/{nombre}/{apellido}/{marca}/{modelo}/{comentarios}/{serial}/{customid}/{nitval}/{tipo}', [OrderController::class, 'create'], ['cui','nombre', 'apellido', 'marca', 'modelo', 'comentarios', 'serial', 'customid', 'nitval', 'tipo'])->name('order.create');

    Route::post('servicio_tecnico/orden/store', [OrderController::class, 'store'])->name('order.store');

    Route::get('servicio_tecnico/ordenes/ver/{id}', [OrderController::class, 'show'])->name('order.show'); /*dirección para ver los datos de la orden creada */

    Route::get('servicio_tecnico/ordenes/asignar', [OrderController::class, 'showa'])->name('order.asig');

    Route::get('servicio_tecnico/ordenes/reparacion', [OrderController::class, 'repair'])->name('order.rep');

    Route::get('servicio_tecnico/ordenes/reparacion/{norden?}', [OrderController::class, 'repairord'])->name('order.repord');

    Route::post('servicio_tecnico/ordenes/reparacion/finalizar', [OrderController::class, 'repairf'])->name('order.repf');

    Route::post('servicio_tecnico/orden/asignar/{id?}', [OrderController::class, 'asignar'])->name('order.asignado');

    Route::get('servicio_tecnico/orden/asignado/{id?}', [OrderController::class, 'asignar1'])->name('order.asignar');

    Route::get('servicio_tecnico/ordenes/ver/{orden?}/update', [OrderController::class, 'update'])->name('order.update'); /*dirección para ver los datos que se actualizaran */

    Route::post('servicio_tecnico/ordenes/ver/update/actualizar/{id?}', [OrderController::class, 'updated'])->name('order.updated'); /* dirección para actualizar los datos */

    Route::get('servicio_tecnico/ordenes/print/{dato?}', [OrderController::class, 'imprimir'])->name('order.imprimir'); /* dirección para imprimir los datos */

    Route::get('orden/buscar', [OrderController::class, 'obusqueda'])->name('orden.busqueda');

    Route::post('servicio_tecnico/ordenes/entrega', [OrderController::class, 'entrega'])->name('orden.entrega');


    /* hardware route */
    Route::get('servicio_tecnico/ordenes/hardware/{dpi?}/{nit?}', [HardwareController::class, 'index'])->name('order.hardware');

    Route::post('hardware', [HardwareController::class, 'store'])->name('hardware.create');

    Route::get('servicio_tecnico/orden/cliente/hardware', [HardwareController::class, 'show'])->name('hardware.show');

    Route::post('servicio_tecnico/hardware/updated/{id?}', [HardwareController::class, 'updated'])->name('hardware.updated');

    Route::get('hardware/buscar', [HardwareController::class, 'hbusqueda'])->name('hardware.busqueda');

    /*  fin harware route */


    /* cliente - customer */

    Route::get('customer/buscar', [CustomerController::class, 'cbusqueda'])->name('customer.busqueda');

    Route::get('servicio_tecnico/ordenes/cliente/index', [CustomerController::class, 'index'])->name('cliente.index');

    Route::get('servicio_tecnico/ordenes/cliente/crear', [CustomerController::class, 'create'])->name('cliente.create');

    Route::get('servicio_tecnico/orden/cliente/show', [CustomerController::class, 'show'])->name('cliente.show');

    Route::post('servicio_tecnico/cliente/updated/{id?}', [CustomerController::class, 'updated'])->name('cliente.updated');

    Route::post('cliente', [CustomerController::class, 'store'])->name('cliente.store');
    
    
    /* rutas para costos */
    Route::get('servicio_tecnico/ordenes/costos/ver', [CostController::class, 'index'])->name('costo.index');
    
    Route::get('servicio_tecnico/ordenes/costos/crear', [CostController::class, 'create'])->name('costo.create');
    
    Route::get('servicio_tecnico/costo/show/{id?}', [CostController::class, 'show'])->name('costo.show');
    
    Route::get('servicio_tecnico/costo/show/update/{id?}', [CostController::class, 'update'])->name('cost.update');
    
    Route::get('costo/{id?}', [CostController::class, 'store'])->name('cost.store');
    
    // Route::post('servicio_tecnico/aceptar/presupuesto', [CostController::class], 'aceptar')->name('costo.aceptar');
    
    Route::post('aceptar', [CostController::class, 'aceptar'])->name('costo.aceptar');

    /* rutas para presupuestos */
    Route::get('servicio_tecnico/ordenes/{dato?}/presupuesto', [BudgetController::class, 'create'])->name('budget.create');

    Route::post('servicio_tecnico/ordenes/presupuesto/{id?}/store', [BudgetController::class, 'store'])->name('budget.store');

    Route::post('guardar', [BudgetController::class, 'guardar'])->name('budget.guardar');

    Route::get('servicio_tecnico/ordenes/presupuesto/delete/{id?}', [BudgetController::class, 'destoy'])->name('budget.destro');

    Route::get('presupuesto', [BudgetController::class, 'bpresu'])->name('presu');

    Route::get('servicio_tecnico/ordenes/prespuesto/ver', [BudgetController::class, 'index'])->name('budget.index');


    /* 
ruta para login
*/
});




Route::get('servicio_tecnico/pruebas', function () {
    return view('slidebar.dashboard');
});

/* ruta de prueba */
Route::get('consulta', [OrderController::class, 'consu'])->name('consult');

Route::Post('consulta/presupuesto/{id?}', [CostController::class, 'clientepresupuesto'])->name('costo.presupuesto');

Route::get('estadovista/{id?}/{estado?}',[OrderController::class, 'estadovisita'])->name('estado.visita');

Route::get('Empresa/consulta', function () {
    return view('consulta.consulta');
});
