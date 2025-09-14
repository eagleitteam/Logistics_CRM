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
        Schema::create('fixed_vehicles', function (Blueprint $table) {
            $table->id();
            
            $table->foreignIdFor(Clientmaster::class)->nullable()->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('vehicle_number');
            $table->string('fixed_km');
            $table->string('fixed_price');
            $table->string('extra_km_rate');
            $table->string('vehicle_type');
            
            
            
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
        Schema::dropIfExists('fixed_vehicles');
    }
};
