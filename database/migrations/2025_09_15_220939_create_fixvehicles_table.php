<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Clientmaster;
use App\Models\fixvehicleclients;
use App\Models\SelfVehicle;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fixvehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(fixvehicleclients::class)->nullable()->constrained();
            $table->foreignIdFor(Clientmaster::class)->nullable()->constrained();
            $table->foreignIdFor(SelfVehicle::class)->nullable()->constrained();
            $table->string('vehical_type');
            $table->string('fixed_km');
            $table->string('fixed_price');
            $table->string('extra_km_rate');

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
        Schema::dropIfExists('fixvehicles');
    }
};
