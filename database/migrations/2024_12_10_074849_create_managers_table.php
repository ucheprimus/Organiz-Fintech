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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->foreignId('branch_id')->unique()->constrained('branches');  // One-to-one relationship with Branch
            $table->foreignId('role_id')->constrained('roles');  // Foreign key for role
            $table->date('start_date');
            $table->decimal('salary', 10, 2);
            $table->string('status')->default('active');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};
