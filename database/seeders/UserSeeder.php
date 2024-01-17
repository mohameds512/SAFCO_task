<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);

        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $admin->assignRole($adminRole);
        $adminPermissions = $adminRole->permissions;
        foreach ($adminPermissions as $permission) {
            $admin->givePermissionTo($permission);
        }

        $User = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('12345678'),
        ]);

        $userRole = Role::where('name', 'user')->firstOrFail();
        $User->assignRole($userRole);
        $userPermissions = $userRole->permissions;
        foreach ($userPermissions as $permission) {
            $User->givePermissionTo($permission);
        }

    }
}
