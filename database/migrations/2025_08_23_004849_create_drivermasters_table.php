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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('basic_salary')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('resigning_date')->nullable();
            $table->string('alternate_contact_no')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('upi_reference_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('upi_number')->nullable();
            $table->string('aadhar_card_number')->nullable();
            $table->string('aadhar_card_path')->nullable();
            $table->string('pan_card_path')->nullable();
            $table->string('driving_license_path')->nullable();
            $table->string('driving_license_validity')->nullable();
            $table->string('remark')->nullable();
            $table->string('categories')->nullable();
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
