<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            'create users',
            'read users',
            'edit users',
            'delete users',
            'create products',
            'read products',
            'edit products',
            'delete products',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($permissions);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['create products', 'edit products','read products']);

    }
}
