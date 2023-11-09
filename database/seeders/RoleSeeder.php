<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Técnico']);
        $role3 = Role::create(['name' => 'Recepción']);

        Permission::create(['name' => 'home', 'description' => 'Acceso al Inicio'])->syncRoles($role1, $role2, $role3);

        Permission::create(['name' => 'admin.user.index', 'description' => 'Ver Usuarios'])->syncRoles($role1);
        Permission::create(['name' => 'admin.user.show', 'description' => 'Detalles de Usuarios'])->syncRoles($role1);
        Permission::create(['name' => 'admin.user.create', 'description' => 'Crear Usuarios'])->syncRoles($role1);
        Permission::create(['name' => 'admin.user.update', 'description' => 'Actualizar datos de Usuarios'])->syncRoles($role1);

        Permission::create(['name' => 'role.index', 'description' => 'Ver roles creados'])->syncRoles($role1);
        Permission::create(['name' => 'role.show', 'description' => 'Ver datos del rol'])->syncRoles($role1);
        Permission::create(['name' => 'role.create', 'description' => 'Crear rol'])->syncRoles($role1);
        Permission::create(['name' => 'role.delete', 'description' => 'Eliminar rol'])->syncRoles($role1);
        Permission::create(['name' => 'role.update', 'description' => 'Actualizar rol'])->syncRoles($role1);

        Permission::create(['name' => 'order.index', 'description' => 'Ver Ordenes de trabajo'])->syncRoles($role1, $role2, $role3);
        Permission::create(['name' => 'order.create', 'description' => 'Crear Orden de Trabajo (O.T)'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'order.show', 'description' => 'Ver detalles de la O.T'])->syncRoles($role1, $role2, $role3);
        Permission::create(['name' => 'order.entrega', 'description' => 'Entregar orden de trabajo'])->syncRoles($role1, $role3);

        Permission::create(['name' => 'order.asig', 'description' => 'Ver datos y formulario para Asignación'])->syncRoles($role1, $role3);//ruta para ver datos de la orden y asignar un técnico
        Permission::create(['name' => 'order.asignado', 'description' => 'Asignar O.T a técnico'])->syncRoles($role1, $role3);//ruta que guarda los datos del técnico y modifica el estado

        Permission::create(['name' => 'order.rep', 'description' => 'Ver ordenes para reparación'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'order.repord', 'description' => 'Formulario para reparación'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'order.repf', 'description' => 'Registrar reparación'])->syncRoles($role1, $role2);

        Permission::create(['name' => 'order.update', 'description' => 'Ver datos para actualizar de una O.T'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'order.updated', 'description' => 'Actualizar datos de la O.T'])->syncRoles($role1, $role3);

        Permission::create(['name' => 'order.imprimir', 'description' => 'Imprimir O.T'])->syncRoles($role1, $role3);

        Permission::create(['name' => 'order.hardware', 'description' => 'Permiso para la sección de hardware'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'order.hardware.create', 'description' => 'Crear registro de datos del hardware'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'order.hardware.show', 'description' => 'Ver datos del hardware'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'order.hardware.updated', 'description' => 'Actualizar datos del hardware'])->syncRoles($role1, $role3);

        Permission::create(['name' => 'order.cliente.index', 'description' => 'Permiso para la sección de cliente'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'order.cliente.create', 'description' => 'Crear registro de datos del cliente'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'order.cliente.show', 'description' => 'Ver datos del Cliente'])->syncRoles($role1, $role3);
        Permission::create(['name' => 'order.cliente.updated', 'description' => 'Actualizar datos del Cliente'])->syncRoles($role1, $role3);

        Permission::create(['name' => 'order.costo.index', 'description' => 'Acceso a la sección de Costos'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'order.costo.create', 'description' => 'Generar costo costo'])->syncRoles($role1, $role2);

        Permission::create(['name' => 'order.budget.create', 'description' => 'Crear presupuesto'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'order.budget.index', 'description' => 'Acceso a la sección de Presupuesto'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'order.budget.show', 'description' => 'Detalles del presupuesto'])->syncRoles($role1, $role2);
        permission::create(['name' => 'order.budget.delete', 'description' => 'Eliminar rol'])->syncRoles($role1, $role2);




    }
}
