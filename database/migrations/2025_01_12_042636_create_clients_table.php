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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('tin')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('identification_type')->nullable();
            $table->string('id_no')->nullable();
            $table->string('upload')->nullable();
            $table->string('utility_bill')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('job_title')->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->integer('job_duration')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_type')->nullable();
            $table->string('account_no')->nullable();
            $table->string('g_name')->nullable();
            $table->string('g_phone')->nullable();
            $table->text('g_address')->nullable();
            $table->string('g_relationship')->nullable();
            $table->string('g_occupation')->nullable();
            $table->string('g_passport')->nullable();
            $table->enum('account_type', ['savings', 'loan', 'investment'])->default('savings');
            $table->unsignedBigInteger('officer')->nullable(); // Allow null if no officer is assigned
            $table->foreign('officer')->references('id')->on('loan_officers')->onDelete('cascade');
                        $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
