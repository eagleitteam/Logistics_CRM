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
        Schema::create('fuelmasters', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('vehical_number');
            $table->integer('current_km');
            $table->decimal('fuel_qty', 10, 2);
            $table->decimal('fuel_rate', 10, 2);
            $table->string('driver_name');
            $table->string('payment_method');
            $table->integer('distance');
            $table->decimal('fuel_amt', 10, 2);
            $table->decimal('avg', 10, 2);
            $table->text('note')->nullable();

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
        Schema::dropIfExists('fuelmasters');
    }
};
