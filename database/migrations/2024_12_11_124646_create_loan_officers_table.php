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
        Schema::create('loan_officers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob');
            $table->string('nationality');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('ssn');
            $table->string('profile_picture')->nullable();
            $table->string('employee_id')->unique();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('manager_id');
            $table->string('branch');
            $table->date('date_of_hire');
            $table->enum('employment_status', ['active', 'onLeave', 'terminated']);
            $table->enum('employment_type', ['fullTime', 'partTime', 'contract']);
            $table->integer('work_schedule');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_officers');
    }
};
