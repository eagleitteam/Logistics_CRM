<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drivermasters', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('mobile_no');
            $table->string('basic_salary');
            $table->date('joining_date');
            $table->date('resigning_date');
            $table->string('alternate_contact_no');
            $table->text('address');
            $table->string('email');
            $table->string('city');
            $table->integer('pincode');
            $table->string('state');
            $table->string('bank_name');
            $table->string('bank_account_no');
            $table->string('ifsc_code');
            $table->string('upi_reference_name');
            $table->string('bank_branch');
            $table->string('upi_number');
            $table->string('aadhar_card_number');
            $table->tinyInteger('aadhar_card_path');
            $table->date('pan_card_path');
            $table->string('driving_license_path');
            $table->date('driving_license_validity')->nullable();
            $table->string('remark')->nullable();
            $table->string('categories');
            $table->string('master_id')->nullable();
            $table->string('group_id')->nullable();
            $table->string('subgroup_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active, 2=Inactive');

            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();       // adds created_at and updated_at
            $table->softDeletes();      // adds deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivermasters');
    }
};
