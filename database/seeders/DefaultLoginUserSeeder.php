<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class DefaultLoginUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Super Admin Seeder ##
        $superAdminRole = Role::updateOrCreate(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $superAdminRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'email' => 'superadmin@gmail.com'
        ], [
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'mobile' => '9999999991',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole([$superAdminRole->id]);



        // Admin Seeder ##
        $adminRole = Role::updateOrCreate(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $adminRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'mobile' => '9999999992',
            'password' => Hash::make('12345678')
        ]);
        $user->assignRole([$adminRole->id]);


        // Ward HOD Seeder ##
        // $wardRole = Role::updateOrCreate(['name' => 'Ward HOD']);
        // $permissions = Permission::whereIn('id', [1, 17, 18, 19, 53, 54, 55, 65, 66, 67, 68, 69, 70, 71, 79, 80, 81, 82, 83, 84, 86, 88, 89, 90, 91, 92, 93, 94, 96, 97, 98,99,100,101,102,129,130,131,132,133,134,135,136,137,138,140,141,142,143,144,149])->pluck('id', 'id')->all();
        // $wardRole->syncPermissions($permissions);

        // $user = User::updateOrCreate([
        //     'email' => 'ward@gmail.com'
        // ], [
        //     'name' => 'Ward',
        //     'email' => 'ward@gmail.com',
        //     'mobile' => '9999999993',
        //     'ward_id' => 1,
        //     'password' => Hash::make('12345678')
        // ]);
        // $user->assignRole([$wardRole->id]);
    }
}
