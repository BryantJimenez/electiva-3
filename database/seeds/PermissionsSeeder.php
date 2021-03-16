<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permiso para Acceder al Panel Administrativo
        Permission::create(['name' => 'dashboard']);

        // Permisos de Usuarios
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.show']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
        Permission::create(['name' => 'users.active']);
        Permission::create(['name' => 'users.deactive']);

        // Permisos de Banners
        Permission::create(['name' => 'banners.index']);
        Permission::create(['name' => 'banners.create']);
        Permission::create(['name' => 'banners.edit']);
        Permission::create(['name' => 'banners.delete']);
        Permission::create(['name' => 'banners.active']);
        Permission::create(['name' => 'banners.deactive']);

        // Permisos de Categorías
        Permission::create(['name' => 'categories.index']);
        Permission::create(['name' => 'categories.create']);
        Permission::create(['name' => 'categories.edit']);
        Permission::create(['name' => 'categories.delete']);
        Permission::create(['name' => 'categories.active']);
        Permission::create(['name' => 'categories.deactive']);

        // Permisos de Productos
    	Permission::create(['name' => 'products.index']);
    	Permission::create(['name' => 'products.create']);
    	Permission::create(['name' => 'products.edit']);
    	Permission::create(['name' => 'products.delete']);
        Permission::create(['name' => 'products.active']);
        Permission::create(['name' => 'products.deactive']);

        // Permisos de Pedidos
        Permission::create(['name' => 'orders.index']);
        Permission::create(['name' => 'orders.show']);
        Permission::create(['name' => 'orders.active']);
        Permission::create(['name' => 'orders.deactive']);

        // Permisos de Pagos
        Permission::create(['name' => 'payments.index']);
        Permission::create(['name' => 'payments.show']);
        Permission::create(['name' => 'payments.active']);
        Permission::create(['name' => 'payments.deactive']);

        // Permisos de Cupones
        Permission::create(['name' => 'coupons.index']);
        Permission::create(['name' => 'coupons.create']);
        Permission::create(['name' => 'coupons.edit']);
        Permission::create(['name' => 'coupons.delete']);

        // Permisos de Ajustes
        Permission::create(['name' => 'settings.edit']);

    	$superadmin=Role::create(['name' => 'Super Admin']);
        $superadmin->givePermissionTo(Permission::all());
        
        $admin=Role::create(['name' => 'Administrador']);
    	$admin->givePermissionTo(Permission::all());

        $client=Role::create(['name' => 'Cliente']);

    	$user=User::find(1);
    	$user->assignRole('Super Admin');
    }
}
