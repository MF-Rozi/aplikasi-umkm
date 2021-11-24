<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    // Reset cached roles and permissions
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $user =User::factory()->state([
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ])->hasProfile(1)->create();


        $role = Role::findByName('super-admin');
        $user->roles()->detach();
        $user->assignRole($role);


    }
}
