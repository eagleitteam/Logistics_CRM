<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Yearmaster;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
                            
            $table->foreignIdFor(Yearmaster::class)->nullable()->constrained();
                        
            $table->integer('month_id')->nullable()->comment('driver,employee id');
            $table->integer('employee_id')->nullable();

            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();

            $table->integer('total_days')->default(0);
            $table->integer('present_days')->default(0);
            $table->integer('absent_days')->default(0);
            $table->integer('leave_days')->default(0);
            $table->integer('half_days')->default(0);

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
        Schema::dropIfExists('attendances');
    }
};
