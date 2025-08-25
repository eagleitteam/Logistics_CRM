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
        Schema::create('bankmasters', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('act_type')->comment('1=Current, 2=Saving , 3=Over Draft');
            $table->string('Bank_Name');
            $table->string('BankBranch');
            $table->string('BankAccountNo', 20);
            $table->string('BankIFSCCode');
            $table->decimal('opening_amt', 10, 2)->nullable();
            $table->tinyInteger('dr_cr')->comment('0=Debit, 1=Credit')->nullable();
            $table->string('year_master')->nullable();
            $table->text('Remark')->nullable();
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
        Schema::dropIfExists('bankmasters');
    }
};
