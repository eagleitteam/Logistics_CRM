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
        Schema::create('vendormasters', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->text('vendor_address');
            $table->boolean('gst_status');
            $table->string('gst_no');
            $table->boolean('tds_applicable');
            $table->integer('tds_rate');
            $table->string('contact_name');
            $table->integer('contact_no');
            $table->integer('alternate_contact_no');
            $table->string('email');
            $table->string('city');
            $table->integer('pincode');
            $table->string('state');
            $table->string('master_group_Category');
            $table->string('master_id');
            $table->string('group_id');
            $table->string('subgroup_id');
            $table->decimal('opening_amt', 10, 2);
            $table->tinyInteger('dr_cr')->comment('0=Debit, 1=Credit');
            $table->string('year_master');
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
        Schema::dropIfExists('vendormasters');
    }
};
