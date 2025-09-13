<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Drivermaster;
use App\Models\Clientmaster;
use App\Models\VehicleTypeMaster;
use App\Models\SelfVehicle;
use App\Models\Vendormaster;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trip_movements', function (Blueprint $table) {
            $table->id();
            $table->text('unique_no')->nullable();
            $table->date('trip_date')->nullable();
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('vehicle_no')->nullable();
            // Client & vendor relations
            $table->string('vehicle_type_id')->nullable();
            $table->string('client_id')->nullable();
            $table->string('driver_id')->nullable();

            $table->text('rate')->nullable();
            $table->text('vehicle_type_category')->nullable();
            $table->text('vendor_id')->nullable();
            $table->text('remark')->nullable();
            $table->text('pod_no')->nullable();
            $table->text('pod_document')->nullable();
            $table->text('courier_date')->nullable();
            $table->text('courier')->nullable();
            $table->text('courier_tracking_number')->nullable();
            $table->text('pod_status')->nullable();
            $table->text('courier_status')->nullable();
            $table->text('invocie_no')->nullable();
            $table->text('invoice_status')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_moments');
    }
};
