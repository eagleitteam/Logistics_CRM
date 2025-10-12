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
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('current_km')->nullable();
            $table->string('fuel_qty')->nullable();
            $table->string('fuel_rate')->nullable();
            $table->string('fuel_amt')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('distance')->nullable();
            $table->string('avg')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuels');
    }
};
