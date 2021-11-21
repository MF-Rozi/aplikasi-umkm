<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        //categories
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);
        Permission::create(['name' => 'create categories']);

        //products
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'create products']);

        //cart
        Permission::create(['name'=> 'add to cart']);
        Permission::create(['name'=> 'remove from cart']);
        Permission::create(['name'=> 'clear cart']);

        //transaction
        Permission::create(['name' => 'do transaction']);
        Permission::create(['name' => 'view transaction']);
        Permission::create(['name' => 'update transaction']);
        Permission::create(['name'=> 'cancel transaction']);
        Permission::create(['name'=> 'cancel own transaction']);
        Permission::create(['name'=> 'view own transaction']);

        Permission::create(['name' => 'do payment']);
        Permission::create(['name'=> 'cancel payment']);

        //notification
        Permission::create(['name'=> 'view own notification']);

        //profile
        Permission::create(['name'=>'update own profile']);

        //user
        Permission::create(['name'=>'ban user']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo(['edit categories',
            'delete categories',
            'create categories',
            'edit products',
            'delete products',
            'create products',
            'update transaction',
            'view transaction',
            'update transaction',
            'cancel transaction',
            'cancel payment',
            'view own notification',
        'ban user','update own profile']);

        $role = Role::create(['name'=> 'customer'])
        ->givePermissionTo(['do transaction',
        'view own transaction',
        'cancel own transaction',
        'do payment',
        'add to cart',
        'remove from cart',
        'clear cart',
        'view own notificaition',
    'update own profile']);


        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
