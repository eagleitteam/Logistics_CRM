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
        Schema::create('companybillingmasters', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_type');
            $table->string('pan_number');
            $table->boolean('gststatus');
            $table->string('gstno')->nullable();
            $table->string('proprietor_name')->nullable();
            $table->boolean('revscharge');
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('pin_code');
            $table->string('contact_number');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('Bank_id');
            $table->string('gst_code_id');
            $table->string('company_logo')->nullable();
            $table->string('company_seal')->nullable();
            $table->string('authorised_signature')->nullable();

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
        Schema::dropIfExists('companybillingmasters');
    }
};
