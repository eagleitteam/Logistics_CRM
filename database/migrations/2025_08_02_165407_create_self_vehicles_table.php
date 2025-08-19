<?php
use App\Models\VehicleTypeMaster;

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
        Schema::create('self_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(VehicleTypeMaster::class)->nullable()->constrained();
            $table->tinyInteger('fule_type')->default(0)->comment('1 => Diesel, 2 => CNG 3=> Electrical');
            $table->date('register_date')->nullable();
            $table->string('type')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('chassis_num')->nullable();
            $table->string('eng_num')->nullable();
            $table->string('model_num')->nullable();
            $table->string('toll_stm')->nullable();
            $table->string('remark')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('status')->nullable();
            
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
        Schema::dropIfExists('self_vehicles');
    }
};
