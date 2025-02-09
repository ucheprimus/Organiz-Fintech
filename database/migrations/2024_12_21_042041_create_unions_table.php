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
        if (!Schema::hasTable('unions')) {
            Schema::create('unions', function (Blueprint $table) {
                $table->id();
                $table->string('union_name');
                $table->string('union_leader');
                $table->integer('number_of_members');
                $table->string('location');
                
                // Foreign keys
                $table->unsignedBigInteger('officer_id')->nullable(); // officer relationship
                $table->unsignedBigInteger('branch_id')->nullable(); // branch relationship
                $table->unsignedBigInteger('manager_id')->nullable(); // manager relationship

                $table->timestamps();

                // Add foreign key constraints
                $table->foreign('officer_id')->references('id')->on('loan_officers')->onDelete('set null');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
                $table->foreign('manager_id')->references('id')->on('managers')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unions');
    }
};
