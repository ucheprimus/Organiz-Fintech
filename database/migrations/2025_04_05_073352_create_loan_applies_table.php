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
        Schema::create('loan_applies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // assuming users apply for loans
            $table->unsignedBigInteger('loan_type_id');
            $table->decimal('loan_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('loan_duration');
            $table->string('repayment_frequency');
            $table->decimal('total_expected_amount', 15, 2);
            $table->decimal('payment_amount', 15, 2);
            $table->date('loan_start_date');
            $table->date('loan_end_date');
            $table->string('collateral')->nullable(); // optional
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applies');
    }
};
