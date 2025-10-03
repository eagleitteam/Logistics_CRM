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
        Schema::create('invoicemasters', function (Blueprint $table) {
            $table->id();
            $table->string('inv_no')->unique();
            $table->date('inv_date')->nullable();
            $table->string('client_id')->nullable();
            $table->string('year_id')->nullable();
            $table->string('template_id')->nullable();
            $table->decimal('net_total', 15, 2)->nullable();
            $table->string('gstMaster_id')->nullable();
            $table->string('igst_percent')->nullable();
            $table->string('igst_amt')->nullable();
            $table->string('cgst_percent')->nullable();
            $table->string('cgst_amt')->nullable();
            $table->string('sgst_percent')->nullable();
            $table->string('sgst_amt')->nullable();
            $table->decimal('gst_amount', 15, 2)->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->string('bank_id')->nullable();
            $table->string('termsconditionmaster_id')->nullable();
            
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
        Schema::dropIfExists('invoicemasters');
    }
};
