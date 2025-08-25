<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'name' => 'dashboard.view',
                'group' => 'dashboard',
            ],
            [
                'id' => 2,
                'name' => 'users.view',
                'group' => 'users',
            ],
            [
                'id' => 3,
                'name' => 'users.create',
                'group' => 'users',
            ],
            [
                'id' => 4,
                'name' => 'users.edit',
                'group' => 'users',
            ],
            [
                'id' => 5,
                'name' => 'users.delete',
                'group' => 'users',
            ],
            [
                'id' => 6,
                'name' => 'users.toggle_status',
                'group' => 'users',
            ],
            [
                'id' => 7,
                'name' => 'users.change_password',
                'group' => 'users',
            ],
            [
                'id' => 8,
                'name' => 'roles.view',
                'group' => 'roles',
            ],
            [
                'id' => 9,
                'name' => 'roles.create',
                'group' => 'roles',
            ],
            [
                'id' => 10,
                'name' => 'roles.edit',
                'group' => 'roles',
            ],
            [
                'id' => 11,
                'name' => 'roles.delete',
                'group' => 'roles',
            ],
            [
                'id' => 12,
                'name' => 'roles.assign',
                'group' => 'roles',
            ],
            [
                'id' => 13,
                'name' => 'wards.view',
                'group' => 'wards',
            ],
            [
                'id' => 14,
                'name' => 'wards.create',
                'group' => 'wards',
            ],
            [
                'id' => 15,
                'name' => 'wards.edit',
                'group' => 'wards',
            ],
            [
                'id' => 16,
                'name' => 'wards.delete',
                'group' => 'wards',
            ],
            [
                'id' => 17,
                'name' => 'yearmasters.view',
                'group' => 'yearmasters',
            ],
            [
                'id' => 18,
                'name' => 'yearmasters.create',
                'group' => 'yearmasters',
            ],
            [
                'id' => 19,
                'name' => 'yearmasters.edit',
                'group' => 'yearmasters',
            ],
            [
                'id' => 20,
                'name' => 'yearmasters.delete',
                'group' => 'yearmasters',
            ],
            [
                'id' => 21,
                'name' => 'statemasters.view',
                'group' => 'statemasters',
            ],
            [
                'id' => 22,
                'name' => 'statemasters.create',
                'group' => 'statemasters',
            ],
            [
                'id' => 23,
                'name' => 'statemasters.edit',
                'group' => 'statemasters',
            ],
            [
                'id' => 24,
                'name' => 'statemasters.delete',
                'group' => 'statemasters',
            ],
            [
                'id' => 25,
                'name' => 'vendormaster.view',
                'group' => 'vendormaster',
            ],
            [
                'id' => 26,
                'name' => 'vendormaster.create',
                'group' => 'vendormaster',
            ],
            [
                'id' => 27,
                'name' => 'vendormaster.edit',
                'group' => 'vendormaster',
            ],
            [
                'id' => 28,
                'name' => 'vendormaster.delete',
                'group' => 'vendormaster',
            ],
            [
                'id' => 29,
                'name' => 'clientmaster.view',
                'group' => 'clientmaster',
            ],
            [
                'id' => 30,
                'name' => 'clientmaster.create',
                'group' => 'clientmaster',
            ],
            [
                'id' => 31,
                'name' => 'clientmaster.edit',
                'group' => 'clientmaster',
            ],
            [
                'id' => 32,
                'name' => 'clientmaster.delete',
                'group' => 'clientmaster',
            ],
            [
                'id' => 33,
                'name' => 'drivermaster.view',
                'group' => 'drivermaster',
            ],
            [
                'id' => 34,
                'name' => 'drivermaster.create',
                'group' => 'drivermaster',
            ],
            [
                'id' => 35,
                'name' => 'drivermaster.edit',
                'group' => 'drivermaster',
            ],
            [
                'id' => 36,
                'name' => 'drivermaster.delete',
                'group' => 'drivermaster',
            ],
            [
                'id' => 37,
                'name' => 'gstmaster.view',
                'group' => 'gstmaster',
            ],
            [
                'id' => 38,
                'name' => 'gstmaster.create',
                'group' => 'gstmaster',
            ],
            [
                'id' => 39,
                'name' => 'gstmaster.edit',
                'group' => 'gstmaster',
            ],
            [
                'id' => 40,
                'name' => 'gstmaster.delete',
                'group' => 'gstmaster',
            ],
            [
                'id' => 41,
                'name' => 'fuelmaster.view',
                'group' => 'fuelmaster',
            ],
            [
                'id' => 42,
                'name' => 'fuelmaster.create',
                'group' => 'fuelmaster',
            ],
            [
                'id' => 43,
                'name' => 'fuelmaster.edit',
                'group' => 'fuelmaster',
            ],
            [
                'id' => 44,
                'name' => 'fuelmaster.delete',
                'group' => 'fuelmaster',
            ],
            [
                'id' => 45,
                'name' => 'bankmaster.view',
                'group' => 'bankmaster',
            ],
            [
                'id' => 46,
                'name' => 'bankmaster.create',
                'group' => 'bankmaster',
            ],
            [
                'id' => 47,
                'name' => 'bankmaster.edit',
                'group' => 'bankmaster',
            ],
            [
                'id' => 48,
                'name' => 'bankmaster.delete',
                'group' => 'bankmaster',
            ],



        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'id' => $permission['id']
            ], [
                'id' => $permission['id'],
                'name' => $permission['name'],
                'group' => $permission['group']
            ]);
        }
    }
}
