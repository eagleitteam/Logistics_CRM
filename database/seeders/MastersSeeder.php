<?php

namespace Database\Seeders;

use App\Models\Allowance;
use App\Models\Ward;
use App\Models\Clas;
use App\Models\SelfVehicleDOcument;
use App\Models\VehicleTypeMaster;
use App\Models\Yearmaster;
use App\Models\MasterGroup;
use App\Models\Statemaster;
use App\Models\MasterGroupCategory;
use App\Models\SubGroupMaster;
use App\Models\Clientmaster;
use App\Models\Gstmaster;
use App\Models\Departmentmaster;
use App\Models\Branchmaster;
use App\Models\SelfVehicle;
use App\Models\Drivermaster;
use App\Models\TripMovement;


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


         // SELF VEHICLE DOCUMENT Seeder
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

        // VEHICLE TYPE SEEDER
        $vehicle_type_masters = [
            [
                'id' => 1,
                'type_name' => '22 FT',
                'model_no' => '1104',
                'date' => '2022-01-01',
                
            ],
            [
                'id' => 2,
                'type_name' => '32 FT',
                'model_no' => '1194',
                'date' => '2022-01-01',
                
            ],
            [
                'id' => 3,
                'type_name' => '20 FT',
                'model_no' => '1100',
                'date' => '2022-01-01',
                
            ],
            [
                'id' => 4,
                'type_name' => '14 FT',
                'model_no' => '1040',
                'date' => '2022-01-01',
                
            ],
        ];

        foreach ($vehicle_type_masters as $vehicle_type_master) {
            VehicleTypeMaster::updateOrCreate([
                'id' => $vehicle_type_master['id']
            ], [
                'id' => $vehicle_type_master['id'],
                'type_name' => $vehicle_type_master['type_name'],
                'model_no' => $vehicle_type_master['model_no'],
                'date' => $vehicle_type_master['date'],

            ]);
        }

        // YEAR SEEDER
        $yearmasters = [
            [
                'id' => 1,
                'title' => 'F.Y.2025-26',
                'start_date' => '2025-04-01',
                'end_date' => '2026-03-31',
            ],
            [
                'id' => 2,
                'title' => 'F.Y.2024-25',
                'start_date' => '2024-04-01',
                'end_date' => '2025-03-31',
            ],
            [
                'id' => 3,
                'title' => 'F.Y.2022-23',
                'start_date' => '2022-04-01',
                'end_date' => '2023-03-31',
            ],
        ];

        foreach ($yearmasters as $year) {
            Yearmaster::updateOrCreate([
                'id' => $year['id']
            ], [
                'id' => $year['id'],
                'title' => $year['title'],
                'start_date' => $year['start_date'],
                'end_date' => $year['end_date'],
            ]);
        }

        // MASTER GROUP SEEDER
        $master_groups = [
            [
                'id' => 1,
                'master_group_name' => 'Balance-Sheet--> Assets',
                'dr_cr' => '2',
            ],
            [
                'id' => 2,
                'master_group_name' => 'Balance-Sheet--> Liabilities',
                'dr_cr' => '1',
            ],
            [
                'id' => 3,
                'master_group_name' => 'Profit & Loss--> Income',
                'dr_cr' => '1',
            ],
            [
                'id' => 4,
                'master_group_name' => 'Profit & Loss--> Expences',
                'dr_cr' => '2',
            ],

        ];

        foreach ($master_groups as $group) {
            MasterGroup::updateOrCreate([
                'id' => $group['id']
            ], [
                'id' => $group['id'],
                'master_group_name' => $group['master_group_name'],
                'dr_cr' => $group['dr_cr'],
            ]);
        }

        // state seeder
        $statemasters = [
                ['id' => 1,  'stateCode' => '01', 'stateName' => 'Jammu and Kashmir'],
                ['id' => 2,  'stateCode' => '02', 'stateName' => 'Himachal Pradesh'],
                ['id' => 3,  'stateCode' => '03', 'stateName' => 'Punjab'],
                ['id' => 4,  'stateCode' => '04', 'stateName' => 'Chandigarh'],
                ['id' => 5,  'stateCode' => '05', 'stateName' => 'Uttarakhand'],
                ['id' => 6,  'stateCode' => '06', 'stateName' => 'Haryana'],
                ['id' => 7,  'stateCode' => '07', 'stateName' => 'Delhi'],
                ['id' => 8,  'stateCode' => '08', 'stateName' => 'Rajasthan'],
                ['id' => 9,  'stateCode' => '09', 'stateName' => 'Uttar Pradesh'],
                ['id' => 10, 'stateCode' => '10', 'stateName' => 'Bihar'],
                ['id' => 11, 'stateCode' => '11', 'stateName' => 'Sikkim'],
                ['id' => 12, 'stateCode' => '12', 'stateName' => 'Arunachal Pradesh'],
                ['id' => 13, 'stateCode' => '13', 'stateName' => 'Nagaland'],
                ['id' => 14, 'stateCode' => '14', 'stateName' => 'Manipur'],
                ['id' => 15, 'stateCode' => '15', 'stateName' => 'Mizoram'],
                ['id' => 16, 'stateCode' => '16', 'stateName' => 'Tripura'],
                ['id' => 17, 'stateCode' => '17', 'stateName' => 'Meghalaya'],
                ['id' => 18, 'stateCode' => '18', 'stateName' => 'Assam'],
                ['id' => 19, 'stateCode' => '19', 'stateName' => 'West Bengal'],
                ['id' => 20, 'stateCode' => '20', 'stateName' => 'Jharkhand'],
                ['id' => 21, 'stateCode' => '21', 'stateName' => 'Odisha'],
                ['id' => 22, 'stateCode' => '22', 'stateName' => 'Chhattisgarh'],
                ['id' => 23, 'stateCode' => '23', 'stateName' => 'Madhya Pradesh'],
                ['id' => 24, 'stateCode' => '24', 'stateName' => 'Gujarat'],
                ['id' => 25, 'stateCode' => '25', 'stateName' => 'Daman and Diu'],
                ['id' => 26, 'stateCode' => '26', 'stateName' => 'Dadra and Nagar Haveli and Daman and Diu'], // Updated merged UT
                ['id' => 27, 'stateCode' => '27', 'stateName' => 'Maharashtra'],
                ['id' => 28, 'stateCode' => '28', 'stateName' => 'Andhra Pradesh (Old)'], // Obsolete, kept for reference
                ['id' => 29, 'stateCode' => '29', 'stateName' => 'Karnataka'],
                ['id' => 30, 'stateCode' => '30', 'stateName' => 'Goa'],
                ['id' => 31, 'stateCode' => '31', 'stateName' => 'Lakshadweep'],
                ['id' => 32, 'stateCode' => '32', 'stateName' => 'Kerala'],
                ['id' => 33, 'stateCode' => '33', 'stateName' => 'Tamil Nadu'],
                ['id' => 34, 'stateCode' => '34', 'stateName' => 'Puducherry'],
                ['id' => 35, 'stateCode' => '35', 'stateName' => 'Andaman and Nicobar Islands'],
                ['id' => 36, 'stateCode' => '36', 'stateName' => 'Telangana'],
                ['id' => 37, 'stateCode' => '37', 'stateName' => 'Andhra Pradesh'],
                ['id' => 38, 'stateCode' => '38', 'stateName' => 'Ladakh']
            ];



        foreach ($statemasters as $state_master) {
            Statemaster::updateOrCreate([
                'id' => $state_master['id']
            ], [
                'id' => $state_master['id'],
                'stateName' => $state_master['stateName'],
                'stateCode' => $state_master['stateCode'],
            ]);
        }

        // Master Group Category seeder

        $master_group_categories = [
            // ---------------- BALANCE SHEET ----------------
            // Assets
            [
                'id' => 1,
                'master_group_id' => 1,
                'group_name' => 'Fixed Assets',
            ],
            [
                'id' => 2,
                'master_group_id' => 1,
                'group_name' => 'Current Assets',
            ],
            [
                'id' => 3,
                'master_group_id' => 1,
                'group_name' => 'Investments',
            ],
            [
                'id' => 4,
                'master_group_id' => 1,
                'group_name' => 'Loans & Advances',
            ],

            // Liabilities
            [
                'id' => 5,
                'master_group_id' => 2,
                'group_name' => 'Capital Account',
            ],
            [
                'id' => 6,
                'master_group_id' => 2,
                'group_name' => 'Reserves & Surplus',
            ],
            [
                'id' => 7,
                'master_group_id' => 2,
                'group_name' => 'Current Liabilities',
            ],
            [
                'id' => 8,
                'master_group_id' => 2,
                'group_name' => 'Loans (Liabilities)',
            ],

            // ---------------- PROFIT & LOSS ----------------
            // Income
            [
                'id' => 9,
                'master_group_id' => 3,
                'group_name' => 'Sales Accounts',
            ],
            [
                'id' => 10,
                'master_group_id' => 3,
                'group_name' => 'Direct Income',
            ],
            [
                'id' => 11,
                'master_group_id' => 3,
                'group_name' => 'Indirect Income',
            ],

            // Expenses
            [
                'id' => 12,
                'master_group_id' => 4,
                'group_name' => 'Direct Expenses',
            ],
            [
                'id' => 13,
                'master_group_id' => 4,
                'group_name' => 'Indirect Expenses',
            ],
            [
                'id' => 14,
                'master_group_id' => 4,
                'group_name' => 'Salary Expenses',
            ],
        ];

        foreach ($master_group_categories as $master_group_category) {
            MasterGroupCategory::updateOrCreate(
                ['id' => $master_group_category['id']],
                [
                    'id' => $master_group_category['id'],
                    'master_group_id' => $master_group_category['master_group_id'],
                    'group_name'      => $master_group_category['group_name'],
                ]
            );
        }

        // SUB GROUP MASTER SEEDER
        $sub_group_masters = [

            // ---------------- BALANCE SHEET ----------------
            // Assets
            [
                'id' => 1,
                'master_group_id' => 1,
                'master_group_category_id' => 1, // Fixed Assets
                'sub_group_name' => 'Building',
            ],
            [
                'id' => 2,
                'master_group_id' => 1,
                'master_group_category_id' => 1, // Fixed Assets
                'sub_group_name' => 'Furniture & Fixtures',
            ],
            [
                'id' => 3,
                'master_group_id' => 1,
                'master_group_category_id' => 2, // Current Assets
                'sub_group_name' => 'Cash-in-Hand',
            ],
            [
                'id' => 4,
                'master_group_id' => 1,
                'master_group_category_id' => 2, // Current Assets
                'sub_group_name' => 'Bank Accounts',
            ],
            [
                'id' => 5,
                'master_group_id' => 1,
                'master_group_category_id' => 2, // Current Assets
                'sub_group_name' => 'Sundry Debtors',
            ],

            // Liabilities
            [
                'id' => 6,
                'master_group_id' => 2,
                'master_group_category_id' => 5, // Capital Account
                'sub_group_name' => 'Proprietor Capital',
            ],
            [
                'id' => 7,
                'master_group_id' => 2,
                'master_group_category_id' => 7, // Current Liabilities
                'sub_group_name' => 'Sundry Creditors',
            ],
            [
                'id' => 8,
                'master_group_id' => 2,
                'master_group_category_id' => 7, // Current Liabilities
                'sub_group_name' => 'Duties & Taxes',
            ],
            [
                'id' => 9,
                'master_group_id' => 2,
                'master_group_category_id' => 8, // Loans (Liabilities)
                'sub_group_name' => 'Secured Loans',
            ],
            [
                'id' => 10,
                'master_group_id' => 2,
                'master_group_category_id' => 8, // Loans (Liabilities)
                'sub_group_name' => 'Unsecured Loans',
            ],

            // ---------------- PROFIT & LOSS ----------------
            // Income
            [
                'id' => 11,
                'master_group_id' => 3,
                'master_group_category_id' => 9, // Sales Accounts
                'sub_group_name' => 'Domestic Sales',
            ],
            [
                'id' => 12,
                'master_group_id' => 3,
                'master_group_category_id' => 9, // Sales Accounts
                'sub_group_name' => 'Export Sales',
            ],
            [
                'id' => 13,
                'master_group_id' => 3,
                'master_group_category_id' => 11, // Indirect Income
                'sub_group_name' => 'Commission Income',
            ],
            [
                'id' => 14,
                'master_group_id' => 3,
                'master_group_category_id' => 11, // Indirect Income
                'sub_group_name' => 'Interest Received',
            ],

            // Expenses
            [
                'id' => 15,
                'master_group_id' => 4,
                'master_group_category_id' => 12, // Direct Expenses
                'sub_group_name' => 'Purchase Accounts',
            ],
            [
                'id' => 16,
                'master_group_id' => 4,
                'master_group_category_id' => 13, // Indirect Expenses
                'sub_group_name' => 'Rent Expenses',
            ],
            [
                'id' => 17,
                'master_group_id' => 4,
                'master_group_category_id' => 13, // Indirect Expenses
                'sub_group_name' => 'Office Expenses',
            ],
            [
                'id' => 18,
                'master_group_id' => 4,
                'master_group_category_id' => 14, // Salary Expenses
                'sub_group_name' => 'Staff Salary',
            ],
            [
                'id' => 19,
                'master_group_id' => 4,
                'master_group_category_id' => 14, // Salary Expenses
                'sub_group_name' => 'Wages',
            ],
        ];

        foreach ($sub_group_masters as $subgroup) {
            SubGroupMaster::updateOrCreate(
                ['id' => $subgroup['id']],
                [
                    'id' => $subgroup['id'],
                    'master_group_id' => $subgroup['master_group_id'],
                    'master_group_category_id' => $subgroup['master_group_category_id'],
                    'sub_group_name'  => $subgroup['sub_group_name'],
                ]
            );
        }

        // Clients Master
        $clientmasters = [
            [
                'id' => 1,
                'client_name' => 'ABC Pvt Ltd',
                'billing_address' => 'Thane, Maharashtra',
                'gst_status' => 1,
                'gst_no' => '22AAAAA0000A1Z5',
                'contact_name' => 'Praful Chavan',
                'contact_no' => '9877182207',
                'alternate_contact_no' => '9987180007',
                'email' => 'praful.abc@gmail.com',
                'city' => 'New Delhi',
                'pincode' => '400605',
                'state' => 27,
                'billing_type' => 1,
                'billing_date' => '2025-08-22',
                'categories' => 1,
                'master_id' => 1,
                'group_id' => 2,
                'subgroup_id' => 5,
                'opening_amt' => 25000.00,
                'dr_cr' => 1,
                'year_master' => 1,
                'status' => 1,

            ],
            [
                'id' => 2,
                'client_name' => 'XYZ Enterprises',
                'billing_address' => 'Andheri East, Mumbai',
                'gst_status' => 1,
                'gst_no' => '27BBBBB1111B2Z6',
                'contact_name' => 'Rahul Mehta',
                'contact_no' => '9123456789',
                'alternate_contact_no' => '9876543210',
                'email' => 'rahul.xyz@gmail.com',
                'city' => 'Mumbai',
                'pincode' => '400059',
                'state' => 27,
                'billing_type' => 2,
                'billing_date' => '2025-08-23',
                'categories' => 1,
                'master_id' => 1,
                'group_id' => 2,
                'subgroup_id' => 5,
                'opening_amt' => 15000.00,
                'dr_cr' => 0,
                'year_master' => 1,
                'status' => 1,

            ],
            [
                'id' => 3,
                'client_name' => 'Tech Innovators',
                'billing_address' => 'Sector 18, Noida',
                'gst_status' => 1,
                'gst_no' => '09CCCCC2222C3Z7',
                'contact_name' => 'Anjali Verma',
                'contact_no' => '9812345678',
                'alternate_contact_no' => '9911223344',
                'email' => 'anjali.tech@gmail.com',
                'city' => 'Noida',
                'pincode' => '201301',
                'state' => 9,
                'billing_type' => 1,
                'billing_date' => '2025-08-24',
                'categories' => 1,
                'master_id' => 1,
                'group_id' => 2,
                'subgroup_id' => 5,
                'opening_amt' => 5000.00,
                'dr_cr' => 1,
                'year_master' => 1,
                'status' => 1,

            ],
            [
                'id' => 4,
                'client_name' => 'Green Supplies',
                'billing_address' => 'Park Street, Kolkata',
                'gst_status' => 0,
                'gst_no' => null,
                'contact_name' => 'Sourav Banerjee',
                'contact_no' => '9876501234',
                'alternate_contact_no' => '9833098765',
                'email' => 'sourav.green@gmail.com',
                'city' => 'Kolkata',
                'pincode' => '700016',
                'state' => 19,
                'billing_type' => 1,
                'billing_date' => '2025-08-25',
                'categories' => 1,
                'master_id' => 1,
                'group_id' => 2,
                'subgroup_id' => 5,
                'opening_amt' => 0.00,
                'dr_cr' => 0,
                'year_master' => 1,
                'status' => 1,

            ],
            [
                'id' => 5,
                'client_name' => 'NextGen Solutions',
                'billing_address' => 'MG Road, Bengaluru',
                'gst_status' => 1,
                'gst_no' => '29DDDDD3333D4Z8',
                'contact_name' => 'Vikas Reddy',
                'contact_no' => '9900112233',
                'alternate_contact_no' => '9988776655',
                'email' => 'vikas.nextgen@gmail.com',
                'city' => 'Bengaluru',
                'pincode' => '560001',
                'state' => 29,
                'billing_type' => 2,
                'billing_date' => '2025-08-26',
                'categories' => 1,
                'master_id' => 1,
                'group_id' => 2,
                'subgroup_id' => 5,
                'opening_amt' => 30000.00,
                'dr_cr' => 1,
                'year_master' => 1,
                'status' => 1,

            ]
        ];

        foreach ($clientmasters as $client) {
            Clientmaster::updateOrCreate(
                ['id' => $client['id']],
                [
                    'id' => $client['id'],
                    'client_name' => $client['client_name'],
                    'billing_address' => $client['billing_address'],
                    'gst_status' => $client['gst_status'],
                    'gst_no' => $client['gst_no'],
                    'contact_name' => $client['contact_name'],
                    'contact_no' => $client['contact_no'],
                    'alternate_contact_no' => $client['alternate_contact_no'],
                    'email' => $client['email'],
                    'city' => $client['city'],
                    'pincode' => $client['pincode'],
                    'state' => $client['state'],
                    'billing_type' => $client['billing_type'],
                    'billing_date' => $client['billing_date'],
                    'categories' => $client['categories'],
                    'master_id' => $client['master_id'],
                    'group_id' => $client['group_id'],
                    'subgroup_id' => $client['subgroup_id'],
                    'opening_amt' => $client['opening_amt'],
                    'dr_cr' => $client['dr_cr'],
                    'year_master' => $client['year_master'],
                    'status' => $client['status'],
                ]
            );
        }

        // gst seeder
        $gstmasters = [
            [
                'id' => 1,
                'code_type' => 1,
                'gst_code' => 'HSN123',
                'code_description' => 'HSN Code Description',
                'igst' => 18,
                'cgst' => 9,
                'sgst' => 9,
                'remark' => 'HSN Remark',
                'status' => 1,
            ],
            [
                'id' => 2,
                'code_type' => 2,
                'gst_code' => 'SAC123',
                'code_description' => 'SAC Code Description',
                'igst' => 18,
                'cgst' => 9,
                'sgst' => 9,
                'remark' => 'SAC Remark',
                'status' => 1,
            ],
        ];

        foreach ($gstmasters as $gst) {
            Gstmaster::updateOrCreate(
                ['id' => $gst['id']],
                [
                    'id' => $gst['id'],
                    'code_type' => $gst['code_type'],
                    'gst_code' => $gst['gst_code'],
                    'code_description' => $gst['code_description'],
                    'igst' => $gst['igst'],
                    'cgst' => $gst['cgst'],
                    'sgst' => $gst['sgst'],
                    'remark' => $gst['remark'],
                    'status' => $gst['status'],
                ]
            );
        }

        // Department Seeder
        $departmentmasters = [
            [
                'id' => 1,
                'department_code' => 'HR-MUM',
                'department_name' => 'Human Resources',
                'head_of_department' => 'Alice Smith',
                'Remark' => 'Handles employee relations',
                'branch_locations' => 1,
                'status' => 1,
            ],
            [
                'id' => 2,
                'department_code' => 'ACC-MUM',
                'department_name' => 'Finance',
                'head_of_department' => 'Bob Johnson',
                'Remark' => 'Manages company finances',
                'branch_locations' => 2,
                'status' => 1,
            ],
        ];

        foreach ($departmentmasters as $department) {
            Departmentmaster::updateOrCreate(
                ['id' => $department['id']],
                [
                    'id' => $department['id'],
                    'department_code' => $department['department_code'],
                    'department_name' => $department['department_name'],
                    'head_of_department' => $department['head_of_department'],
                    'Remark' => $department['Remark'],
                    'branch_locations' => $department['branch_locations'],
                    'status' => $department['status'],
                ]
            );
        }

        // Branch Seeder
        $branchmasters = [
            [
                'id' => 1,
                'branch_code' => 'BR-MUM',
                'branch_location' => 'Mumbai',
                'head_of_branch' => 'John Doe',
                'remark' => 'Main Branch',
                'status' => 1,
            ],
            [
                'id' => 2,
                'branch_code' => 'BR-DEL',
                'branch_location' => 'Delhi',
                'head_of_branch' => 'Jane Smith',
                'remark' => 'Secondary Branch',
                'status' => 1,
            ],
        ];

        foreach ($branchmasters as $branch) {
            Branchmaster::updateOrCreate(
                ['id' => $branch['id']],
                [
                    'id' => $branch['id'],
                    'branch_code' => $branch['branch_code'],
                    'branch_location' => $branch['branch_location'],
                    'head_of_branch' => $branch['head_of_branch'],
                    'remark' => $branch['remark'],
                    'status' => $branch['status'],
                ]
            );
        }



        // Vehicle number Seeder
        $self_vehicles = [
            [
                'id' => 1,
                'vehicle_type_master_id' => 1,
                'fule_type' => 1, // Diesel
                'register_date' => '2025-09-16',
                'type' => 1,
                'vehicle_number' => 'MH 04 GS 0065',
                'chassis_num' => '1256464',
                'eng_num' => '8888888',
                'model_num' => '9833144892',
                'toll_stm' => 'TEST',
                'remark' => 'First Vehicle',
                'vendor_name' => '',
                'status' => 1,
            ],
            [
                'id' => 2,
                'vehicle_type_master_id' => 2,
                'fule_type' => 2, // CNG
                'register_date' => '2025-09-16',
                'type' => 1,
                'vehicle_number' => 'GJ 05 CD 1122',
                'chassis_num' => 'CH12345',
                'eng_num' => 'EN67890',
                'model_num' => 'MDL2025',
                'toll_stm' => 'FASTag-1122',
                'remark' => 'CNG Vehicle',
                'vendor_name' => '',
                'status' => 1,
            ],
            [
                'id' => 3,
                'vehicle_type_master_id' => 1,
                'fule_type' => 3, // Electrical
                'register_date' => '2025-09-16',
                'type' => 1,
                'vehicle_number' => 'MH 12 XY 4567',
                'chassis_num' => 'CH56789',
                'eng_num' => 'EN54321',
                'model_num' => 'EV2025',
                'toll_stm' => 'FASTag-4567',
                'remark' => 'Electric Vehicle',
                'vendor_name' => '',
                'status' => 1,
            ],
            [
                'id' => 4,
                'vehicle_type_master_id' => 3,
                'fule_type' => 1, // Diesel
                'register_date' => '2025-09-16',
                'type' => 1,
                'vehicle_number' => 'MH 14 AB 9988',
                'chassis_num' => 'CH99887',
                'eng_num' => 'EN88776',
                'model_num' => 'MDL9988',
                'toll_stm' => 'FASTag-9988',
                'remark' => 'Long Route Truck',
                'vendor_name' => '',
                'status' => 1,
            ],
            [
                'id' => 5,
                'vehicle_type_master_id' => 4,
                'fule_type' => 2, // CNG
                'register_date' => '2025-09-16',
                'type' => 1,
                'vehicle_number' => 'GJ 01 EF 3344',
                'chassis_num' => 'CH33445',
                'eng_num' => 'EN22334',
                'model_num' => 'MDL3344',
                'toll_stm' => 'FASTag-3344',
                'remark' => 'Mini Truck',
                'vendor_name' => '',
                'status' => 1,
            ],
        ];

        foreach ($self_vehicles as $self_vehicles) {
            SelfVehicle::updateOrCreate(
                ['id' => $self_vehicles['id']],
                [
                    'id' => $self_vehicles['id'],
                    'vehicle_type_master_id' => $self_vehicles['vehicle_type_master_id'],
                    'fule_type' => $self_vehicles['fule_type'],
                    'register_date' => $self_vehicles['register_date'],
                    'type' => $self_vehicles['type'],
                    'vehicle_number' => $self_vehicles['vehicle_number'],
                    'chassis_num' => $self_vehicles['chassis_num'],
                    'eng_num' => $self_vehicles['eng_num'],
                    'model_num' => $self_vehicles['model_num'],
                    'toll_stm' => $self_vehicles['toll_stm'],
                    'remark' => $self_vehicles['remark'],
                    'vendor_name' => $self_vehicles['vendor_name'],
                    'status' => $self_vehicles['status'],
                ]
            );
        }



        //  Driver Seeder
        $drivermasters = [
            [
                'id' => 1,
                'first_name' => 'Rahul',
                'last_name' => 'Deshmukh',
                'mobile_no' => '9833144892',
                'basic_salary' => 20000,
                'joining_date' => '2025-09-11',
                'resigning_date' => null,
                'alternate_contact_no' => '9833288579',
                'address' => 'UP',
                'email' => 'prafullchavan.111@gmail.com',
                'city' => 'Virar',
                'pincode' => '400600',
                'state' => 'Maharashtra',
                'bank_name' => 'State Bank of India',
                'bank_account_no' => '5745788577',
                'ifsc_code' => 'SBIN0000123',
                'upi_reference_name' => 'xrrr',
                'bank_branch' => 'tutyut',
                'upi_number' => '9987180007',
                'aadhar_card_number' => '123456789123',
                'aadhar_card_path' => 'adharCard/aadhar_20250923_MjfnFD.pdf',
                'pan_card_path' => 'panCard/pan_20250923_xPbuZ0.pdf',
                'driving_license_path' => 'drivingLicense/license_20250923_Svd7qj.pdf',
                'driving_license_validity' => '2025-09-26',
                'remark' => null,
                'categories' => 1,
                'master_id' => 2,
                'group_id' => null,
                'subgroup_id' => 10,
                'status' => 1,

            ],
            [
                'id' => 2,
                'first_name' => 'Suresh',
                'last_name' => 'Patil',
                'mobile_no' => '9822001122',
                'basic_salary' => 18000,
                'joining_date' => '2024-05-10',
                'resigning_date' => null,
                'alternate_contact_no' => '9822001133',
                'address' => 'Thane',
                'email' => 'suresh.patil@example.com',
                'city' => 'Thane',
                'pincode' => '400601',
                'state' => 'Maharashtra',
                'bank_name' => 'HDFC Bank',
                'bank_account_no' => '3344556677',
                'ifsc_code' => 'HDFC0000456',
                'upi_reference_name' => 'sureshupi',
                'bank_branch' => 'Thane West',
                'upi_number' => '9822001122@upi',
                'aadhar_card_number' => '123456789456',
                'aadhar_card_path' => 'adharCard/aadhar_suresh.pdf',
                'pan_card_path' => 'panCard/pan_suresh.pdf',
                'driving_license_path' => 'drivingLicense/license_suresh.pdf',
                'driving_license_validity' => '2026-06-15',
                'remark' => 'Good Driver',
                'categories' => 1,
                'master_id' => 2,
                'group_id' => null,
                'subgroup_id' => 11,
                'status' => 1,

            ],
            [
                'id' => 3,
                'first_name' => 'Amit',
                'last_name' => 'Sharma',
                'mobile_no' => '9819002233',
                'basic_salary' => 22000,
                'joining_date' => '2023-08-01',
                'resigning_date' => null,
                'alternate_contact_no' => '9819002244',
                'address' => 'Navi Mumbai',
                'email' => 'amit.sharma@example.com',
                'city' => 'Navi Mumbai',
                'pincode' => '400709',
                'state' => 'Maharashtra',
                'bank_name' => 'ICICI Bank',
                'bank_account_no' => '7788996655',
                'ifsc_code' => 'ICIC0000789',
                'upi_reference_name' => 'amitupi',
                'bank_branch' => 'Vashi',
                'upi_number' => '9819002233@upi',
                'aadhar_card_number' => '456789123456',
                'aadhar_card_path' => 'adharCard/aadhar_amit.pdf',
                'pan_card_path' => 'panCard/pan_amit.pdf',
                'driving_license_path' => 'drivingLicense/license_amit.pdf',
                'driving_license_validity' => '2027-01-20',
                'remark' => 'Long route specialist',
                'categories' => 1,
                'master_id' => 3,
                'group_id' => null,
                'subgroup_id' => 12,
                'status' => 1,

            ],
            [
                'id' => 4,
                'first_name' => 'Vijay',
                'last_name' => 'Kadam',
                'mobile_no' => '9876543210',
                'basic_salary' => 25000,
                'joining_date' => '2022-11-15',
                'resigning_date' => null,
                'alternate_contact_no' => '9876501234',
                'address' => 'Pune',
                'email' => 'vijay.kadam@example.com',
                'city' => 'Pune',
                'pincode' => '411001',
                'state' => 'Maharashtra',
                'bank_name' => 'Axis Bank',
                'bank_account_no' => '5566778899',
                'ifsc_code' => 'UTIB0000234',
                'upi_reference_name' => 'vijayupi',
                'bank_branch' => 'Pune Camp',
                'upi_number' => '9876543210@upi',
                'aadhar_card_number' => '789123456789',
                'aadhar_card_path' => 'adharCard/aadhar_vijay.pdf',
                'pan_card_path' => 'panCard/pan_vijay.pdf',
                'driving_license_path' => 'drivingLicense/license_vijay.pdf',
                'driving_license_validity' => '2028-03-10',
                'remark' => 'Senior driver',
                'categories' => 1,
                'master_id' => 4,
                'group_id' => null,
                'subgroup_id' => 13,
                'status' => 1,

            ],
        ];

        foreach ($drivermasters as $driver) {
            Drivermaster::updateOrCreate(
                ['id' => $driver['id']],
                [
                    'id' => $driver['id'],
                    'first_name' => $driver['first_name'],
                    'last_name' => $driver['last_name'],
                    'mobile_no' => $driver['mobile_no'],
                    'basic_salary' => $driver['basic_salary'],
                    'joining_date' => $driver['joining_date'],
                    'resigning_date' => $driver['resigning_date'],
                    'alternate_contact_no' => $driver['alternate_contact_no'],
                    'address' => $driver['address'],
                    'email' => $driver['email'],
                    'city' => $driver['city'],
                    'pincode' => $driver['pincode'],
                    'state' => $driver['state'],
                    'bank_name' => $driver['bank_name'],
                    'bank_account_no' => $driver['bank_account_no'],
                    'ifsc_code' => $driver['ifsc_code'],
                    'upi_reference_name' => $driver['upi_reference_name'],
                    'bank_branch' => $driver['bank_branch'],
                    'upi_number' => $driver['upi_number'],
                    'aadhar_card_number' => $driver['aadhar_card_number'],
                    'aadhar_card_path' => $driver['aadhar_card_path'],
                    'pan_card_path' => $driver['pan_card_path'],
                    'driving_license_path' => $driver['driving_license_path'],
                    'driving_license_validity' => $driver['driving_license_validity'],
                    'remark' => $driver['remark'],
                    'categories' => $driver['categories'],
                    'master_id' => $driver['master_id'],
                    'group_id' => $driver['group_id'],
                    'subgroup_id' => $driver['subgroup_id'],
                    'status' => $driver['status'],
                ]
            );
        }


        $trip_movements = [
            [
                'id' => 1,
                'unique_no' => '001',
                'trip_date' => '2025-09-15',
                'origin' => 'THANE',
                'destination' => 'BHAIWANDI',
                'vehicle_no' => '1',
                'vehicle_type_id' => 1,
                'client_id' => 1,
                'driver_id' => 1,
                'rate' => 15000,
                'vehicle_type_category' => 1,
                'vendor_id' => null,
                'remark' => null,
                'pod_no' => null,
                'pod_document' => null,
                'courier_date' => null,
                'courier' => null,
                'courier_tracking_number' => null,
                'pod_status' => null,
                'courier_status' => null,
                'invocie_no' => null,
                'invoice_status' => null,

            ],
            [
                'id' => 2,
                'unique_no' => '005',
                'trip_date' => '2025-09-01',
                'origin' => 'THANE',
                'destination' => 'BHAIWANDI',
                'vehicle_no' => '1',
                'vehicle_type_id' => 1,
                'client_id' => 1,
                'driver_id' => 1,
                'rate' => 15000,
                'vehicle_type_category' => 1,
                'vendor_id' => null,
                'remark' => null,
                'pod_no' => null,
                'pod_document' => null,
                'courier_date' => null,
                'courier' => null,
                'courier_tracking_number' => null,
                'pod_status' => null,
                'courier_status' => null,
                'invocie_no' => null,
                'invoice_status' => null,

            ],
            [
                'id' => 3,
                'unique_no' => '002',
                'trip_date' => '2025-09-02',
                'origin' => 'THANE',
                'destination' => 'BHAIWANDI',
                'vehicle_no' => '1',
                'vehicle_type_id' => 1,
                'client_id' => 1,
                'driver_id' => 1,
                'rate' => 15000,
                'vehicle_type_category' => 1,
                'vendor_id' => null,
                'remark' => null,
                'pod_no' => null,
                'pod_document' => null,
                'courier_date' => null,
                'courier' => null,
                'courier_tracking_number' => null,
                'pod_status' => null,
                'courier_status' => null,
                'invocie_no' => null,
                'invoice_status' => null,

            ],
            [
                'id' => 4,
                'unique_no' => '003',
                'trip_date' => '2025-09-03',
                'origin' => 'THANE',
                'destination' => 'BHAIWANDI',
                'vehicle_no' => '1',
                'vehicle_type_id' => 1,
                'client_id' => 1,
                'driver_id' => 1,
                'rate' => 15000,
                'vehicle_type_category' => 1,
                'vendor_id' => null,
                'remark' => null,
                'pod_no' => null,
                'pod_document' => null,
                'courier_date' => null,
                'courier' => null,
                'courier_tracking_number' => null,
                'pod_status' => null,
                'courier_status' => null,
                'invocie_no' => null,
                'invoice_status' => null,

            ],
            [
                'id' => 5,
                'unique_no' => '004',
                'trip_date' => '2025-09-04',
                'origin' => 'THANE',
                'destination' => 'BHAIWANDI',
                'vehicle_no' => '1',
                'vehicle_type_id' => 1,
                'client_id' => 1,
                'driver_id' => 1,
                'rate' => 15000,
                'vehicle_type_category' => 1,
                'vendor_id' => null,
                'remark' => null,
                'pod_no' => null,
                'pod_document' => null,
                'courier_date' => null,
                'courier' => null,
                'courier_tracking_number' => null,
                'pod_status' => null,
                'courier_status' => null,
                'invocie_no' => null,
                'invoice_status' => null,

            ],

        ];

        foreach ($trip_movements as $trip) {
            TripMovement::updateOrCreate(
                ['id' => $trip['id']],
                [
                    'id' => $trip['id'],
                    'unique_no' => $trip['unique_no'],
                    'trip_date' => $trip['trip_date'],
                    'origin' => $trip['origin'],
                    'destination' => $trip['destination'],
                    'vehicle_no' => $trip['vehicle_no'],
                    'vehicle_type_id' => $trip['vehicle_type_id'],
                    'client_id' => $trip['client_id'],
                    'driver_id' => $trip['driver_id'],
                    'rate' => $trip['rate'],
                    'vehicle_type_category' => $trip['vehicle_type_category'],
                    'vendor_id' => $trip['vendor_id'],
                    'remark' => $trip['remark'],
                    'pod_no' => $trip['pod_no'],
                    'pod_document' => $trip['pod_document'],
                    'courier_date' => $trip['courier_date'],
                    'courier' => $trip['courier'],
                    'courier_tracking_number' => $trip['courier_tracking_number'],
                    'pod_status' => $trip['pod_status'],
                    'courier_status' => $trip['courier_status'],
                    'invocie_no' => $trip['invocie_no'],
                    'invoice_status' => $trip['invoice_status'],

                ]
            );
        }



    }
}
