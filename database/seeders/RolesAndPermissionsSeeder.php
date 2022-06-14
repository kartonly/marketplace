<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $usersPermissions = [
            'all' => Permission::firstOrCreate(['name' => 'users']),
            'update' => Permission::firstOrCreate(['name' => 'users.update']),
            'delete' => Permission::firstOrCreate(['name' => 'users.delete']),
            'view' => Permission::firstOrCreate(['name' => 'users.view']),
        ];

        $permissionsPermissions = [
            'all' => Permission::firstOrCreate(['name' => 'permissions']),
            'update' => Permission::firstOrCreate(['name' => 'permissions.update']),
            'delete' => Permission::firstOrCreate(['name' => 'permissions.delete']),
            'view' => Permission::firstOrCreate(['name' => 'permissions.view']),
        ];

        $sellersPermissions = [
            'all' => Permission::firstOrCreate(['name' => 'sellers']),
            'create' => Permission::firstOrCreate(['name' => 'sellers.create']),
            'update' => Permission::firstOrCreate(['name' => 'sellers.update']),
            'delete' => Permission::firstOrCreate(['name' => 'sellers.delete']),
            'view' => Permission::firstOrCreate(['name' => 'sellers.view']),
        ];


        $userRole = Role::firstOrCreate(['name' => \App\Models\Role::USER_ROLE]);
        $userRole->givePermissionTo(
            $usersPermissions['view'],
            $usersPermissions['update'],
        );

        $adminRole = Role::firstOrCreate(['name' => \App\Models\Role::SELLER_ROLE]);
        $adminRole->givePermissionTo(
            $usersPermissions['all'],
            $sellersPermissions['all'],
        );

        $adminRole = Role::firstOrCreate(['name' => \App\Models\Role::ADMIN_ROLE]);
        $adminRole->givePermissionTo(
            $usersPermissions['all'],
            $permissionsPermissions['all'],
            $sellersPermissions['all'],
        );

    }
}
