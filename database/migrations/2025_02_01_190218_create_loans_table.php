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
            Schema::create('loans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('loan_type')->nullable()->constrained()->onDelete('cascade'); 
                $table->decimal('loan_amount', 15, 2);
                $table->decimal('interest_rate', 5, 2);
                $table->integer('loan_duration');
                $table->string('repayment_frequency');
                $table->decimal('total_expected_amount', 15, 2);
                $table->decimal('payment_amount', 15, 2);
                $table->date('loan_start_date');
                $table->date('loan_end_date');
                $table->text('loan_purpose')->nullable();
                $table->decimal('repayment_amount', 15, 2)->default(0);
                $table->decimal('balance', 15, 2)->default(0);
                $table->string('collateral_type')->nullable();
                $table->enum('loan_status', ['Active', 'Fully Paid', 'Overdue', 'Defaulted'])->default('Active'); // Removed ->after('balance')
                $table->timestamps();
            });
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
