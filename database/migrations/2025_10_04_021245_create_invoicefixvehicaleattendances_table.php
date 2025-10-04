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
        Schema::create('invoicefixvehicaleattendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Fixvehicleclients_id')->constrained()->onDelete('cascade');
            $table->foreignId('Fixvehicles_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->enum('attendance_status', ['1', '0']); // 1 for present, 0 for absent
            $table->string('pod_no')->nullable();
            $table->string('pod_documents')->nullable();
            $table->enum('pod_status', ['pending', 'completed']);
            $table->foreignId('drivermasters_id')->constrained();
            $table->integer('start_km')->nullable();
            $table->integer('end_km')->nullable();
            $table->integer('diff_km')->nullable();
            $table->decimal('toll', 10, 2)->nullable();
            $table->decimal('other_charges', 10, 2)->nullable();
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
        Schema::dropIfExists('invoicefixvehicaleattendances');
    }
};
