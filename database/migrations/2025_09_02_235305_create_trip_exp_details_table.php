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
        Schema::create('trip_exp_details', function (Blueprint $table) {
            $table->id();
            $table->text('unique_no')->nullable();
            $table->text('trip_id')->nullable();
            $table->text('toll_charges')->nullable();
            $table->text('loading_unloading_charges')->nullable();
            $table->text('handing_charges')->nullable();
            $table->text('holding_charges')->nullable();
            $table->text('holding_days')->nullable();
            $table->text('other_exp')->nullable();
            $table->text('total_exp')->nullable();
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
        Schema::dropIfExists('trip_exp_details');
    }
};
