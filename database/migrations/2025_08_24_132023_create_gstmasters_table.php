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
        Schema::create('gstmasters', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('code_type')->comment('1=HSN CODE, 2=SAC CODE');
            $table->string('gst_code');
            $table->string('code_description');
            $table->decimal('igst', 10, 2);
            $table->decimal('cgst', 10, 2);
            $table->decimal('sgst', 10, 2);
            $table->tinyInteger('status')->default(1)->comment('1=Active, 2=Inactive');
            $table->text('remark')->nullable();

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
        Schema::dropIfExists('gstmasters');
    }
};
