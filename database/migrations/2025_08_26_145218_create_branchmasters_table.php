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
        Schema::create('branchmasters', function (Blueprint $table) {
            $table->id();
            $table->string('branch_code');
            $table->string('branch_location');
            $table->string('head_of_branch');
            $table->string('remark')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active, 2=Inactive');

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
        Schema::dropIfExists('branchmasters');
    }
};
