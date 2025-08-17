<?php

namespace Database\Seeders;

use App\Models\Allowance;
use App\Models\Ward;
use App\Models\Department;
use App\Models\Bank;
use App\Models\Clas;
use App\Models\Corporation;
use App\Models\Deduction;
use App\Models\Designation;
use App\Models\LeaveType;
use App\Models\FinancialYear;
use App\Models\SelfVehicleDOcument;
use App\Models\Loan;
use App\Models\PayMst;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MastersSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Wards Seeder
        $wards = [
            [
                'id' => 1,
                'name' => 'Ward 1',
                'initial' => 'w1',
            ],
            [
                'id' => 2,
                'name' => 'Ward 2',
                'initial' => 'w2',
            ]
        ];

        foreach ($wards as $ward) {
            Ward::updateOrCreate([
                'id' => $ward['id']
            ], [
                'id' => $ward['id'],
                'name' => $ward['name'],
                'initial' => $ward['initial']
            ]);
        }

      
         // Wards Seeder
        $SelfVehicledocumentSeeder = [
            [
                'id' => 1,
                'name' => 'Fitness',
            ],
            [
                'id' => 2,
                'name' => 'Tax',
            ],
            [
                'id' => 3,
                'name' => 'Insurance',
            ],
            [
                'id' => 4,
                'name' => 'Permit Details',
            ],
            [
                'id' => 5,
                'name' => 'PUC Details',
            ],
            [
                'id' => 6,
                'name' => 'National Permit Details',
            ],
        ];

        foreach ($SelfVehicledocumentSeeder as $SelfVehicledocument) {
            SelfVehicleDOcument::updateOrCreate([
                'id' => $SelfVehicledocument['id']
            ], [
                'id' => $SelfVehicledocument['id'],
                'name' => $SelfVehicledocument['name'],
            ]);
        }
    }
}
